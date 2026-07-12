/**
 * Gráfico de Línea 3D Animado - Caída de Valor en Crisis
 * Crea un gráfico con proyección 3D responsivo y acelerado por hardware en el canvas del hero,
 * con sombras suaves, sombreado ambiental dinámico, animación de entrada y paralaje interactivo con el ratón.
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('down-chart-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const dataBlock = canvas.closest('.data-block');

    // ── Configuración de la Escena 3D ──────────────────────────────────────────
    const F = 600;            // Distancia focal (Focal length / Zoom)
    const cameraZ = 230;      // Distancia de la cámara al origen Z (menor = perspectiva más forzada)

    // Dimensiones del espacio de coordenadas virtuales
    const maxDimX = 550;
    const maxDimY = 400;

    let offsetX = 150;
    let offsetY = 75;
    let baseScale = 1.0;

    // ── Variables de Animación y Estado ───────────────────────────────────────
    let startTime = null;
    let isAnimating = false;
    let isHovered = false;

    // Ángulos de rotación actuales y objetivo (pitch/yaw)
    let currentAngleX = 0; // Inclinación vertical (Pitch)
    let currentAngleY = 0; // Rotación horizontal (Yaw)
    let baseAngleX = 0;
    let baseAngleY = 0;

    // Desplazamientos de paralaje por movimiento del ratón
    let parallaxX = 0;
    let parallaxY = 0;

    // Vector de la fuente de luz para el sombreado dinámico (normalizado, apuntando desde el frente)
    const light = { x: -0.3, y: 0.7, z: 0.8 };
    const lightLen = Math.sqrt(light.x * light.x + light.y * light.y + light.z * light.z);
    light.x /= lightLen;
    light.y /= lightLen;
    light.z /= lightLen;

    // ── Geometría del Gráfico (Máximo 3 quiebres -> 5 puntos en total) ───────────
    // Coordenadas simétricas dentro de los límites de la pared: X [-130, 130], Y [-60, 70]
    const chartPoints = [
        { x: -125, y: 45 },
        { x: -65, y: -10 }, // Quiebre 1 (caída inicial)
        { x: 5, y: 20 },  // Quiebre 2 (recuperación temporal)
        { x: 65, y: -30 }, // Quiebre 3 (segunda caída)
        { x: 125, y: -50 }  // Fin (caída final de valor representando el -11%)
    ];

    // Función de atenuación (easing) para animaciones suaves
    function easeOutCubic(x) {
        return 1 - Math.pow(1 - x, 3);
    }

    // ── Matemáticas de Proyección 3D ──────────────────────────────────────────
    function rotatePoint(x, y, z, angleX, angleY) {
        // 1. Rotación sobre el eje Y (Yaw / Guiñada)
        const cosY = Math.cos(angleY);
        const sinY = Math.sin(angleY);
        const rx = x * cosY - z * sinY;
        const rz = x * sinY + z * cosY;

        // 2. Rotación sobre el eje X (Pitch / Cabeceo)
        const cosX = Math.cos(angleX);
        const sinX = Math.sin(angleX);
        const ry = y * cosX - rz * sinX;
        const rz2 = y * sinX + rz * cosX;

        return { x: rx, y: ry, z: rz2 };
    }

    // Proyecta un punto 3D rotado a coordenadas 2D del canvas (con traslación de origen)
    function projectRotated(rotatedPt) {
        let sz = rotatedPt.z + cameraZ;
        if (sz <= 10) sz = 10;
        const scale = (F / sz) * baseScale;
        const px = offsetX + rotatedPt.x * scale;
        const py = offsetY - rotatedPt.y * scale;
        return { x: px, y: py };
    }

    // Proyecta un punto 3D sin aplicar la traslación del centro (para cálculo de límites)
    function projectRotatedRaw(rotatedPt) {
        let sz = rotatedPt.z + cameraZ;
        if (sz <= 10) sz = 10;
        const scale = (F / sz) * baseScale;
        const px = rotatedPt.x * scale;
        const py = -rotatedPt.y * scale;
        return { x: px, y: py };
    }

    // ── Generar Cinta Extruida 3D (Ribbon) ─────────────────────────────────────
    function generateRibbonFaces(pathPoints, width, depth) {
        const faces = [];
        if (pathPoints.length < 2) return faces;

        // 1. Calcular normales 2D en cada punto de la línea para orientar los bordes
        const normals = [];
        for (let i = 0; i < pathPoints.length; i++) {
            let nx = 0, ny = 0;
            if (i === 0) {
                const dx = pathPoints[1].x - pathPoints[0].x;
                const dy = pathPoints[1].y - pathPoints[0].y;
                const len = Math.sqrt(dx * dx + dy * dy);
                nx = -dy / len;
                ny = dx / len;
            } else if (i === pathPoints.length - 1) {
                const dx = pathPoints[i].x - pathPoints[i - 1].x;
                const dy = pathPoints[i].y - pathPoints[i - 1].y;
                const len = Math.sqrt(dx * dx + dy * dy);
                nx = -dy / len;
                ny = dx / len;
            } else {
                const dx1 = pathPoints[i].x - pathPoints[i - 1].x;
                const dy1 = pathPoints[i].y - pathPoints[i - 1].y;
                const len1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);

                const dx2 = pathPoints[i + 1].x - pathPoints[i].x;
                const dy2 = pathPoints[i + 1].y - pathPoints[i].y;
                const len2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);

                const nx1 = -dy1 / len1;
                const ny1 = dx1 / len1;

                const nx2 = -dy2 / len2;
                const ny2 = dx2 / len2;

                nx = (nx1 + nx2) / 2;
                ny = (ny1 + ny2) / 2;
                const len = Math.sqrt(nx * nx + ny * ny);
                if (len > 0) {
                    nx /= len;
                    ny /= len;
                }
            }
            normals.push({ x: nx, y: ny });
        }

        // 2. Construir vértices (caras frontales y traseras desfasadas por ancho y profundidad)
        const vertices = [];
        const zFront = -4; // Ligeramente desfasado de la pared (Z = 0)
        const zBack = zFront - depth;
        const wHalf = width / 2;

        for (let i = 0; i < pathPoints.length; i++) {
            let pt = pathPoints[i];
            const n = normals[i];

            // Si es el último punto, lo retrocedemos hasta la base de la flecha para que la cinta no sobresalga
            if (i === pathPoints.length - 1 && pathPoints.length >= 2) {
                const prev = pathPoints[i - 1];
                const dx = pt.x - prev.x;
                const dy = pt.y - prev.y;
                const len = Math.sqrt(dx * dx + dy * dy);
                if (len > 0.1) {
                    const tx = dx / len;
                    const ty = dy / len;
                    const arrowLength = width * 1.8;
                    const retro = Math.min(len * 0.9, arrowLength * 0.45);
                    pt = {
                        x: pt.x - tx * retro,
                        y: pt.y - ty * retro
                    };
                }
            }

            vertices.push({
                tf: { x: pt.x + n.x * wHalf, y: pt.y + n.y * wHalf, z: zFront },  // Superior Frontal
                bf: { x: pt.x - n.x * wHalf, y: pt.y - n.y * wHalf, z: zFront },  // Inferior Frontal
                tb: { x: pt.x + n.x * wHalf, y: pt.y + n.y * wHalf, z: zBack },   // Superior Trasero
                bb: { x: pt.x - n.x * wHalf, y: pt.y - n.y * wHalf, z: zBack }    // Inferior Trasero
            });
        }

        // 3. Crear las caras de cada segmento del gráfico
        for (let i = 0; i < pathPoints.length - 1; i++) {
            const v0 = vertices[i];
            const v1 = vertices[i + 1];

            // Cara Frontal (Crimson brillante de frente)
            faces.push({
                points: [v0.tf, v1.tf, v1.bf, v0.bf],
                type: 'front'
            });

            // Cara Trasera
            faces.push({
                points: [v0.tb, v0.bb, v1.bb, v1.tb],
                type: 'back'
            });

            // Cara Superior
            faces.push({
                points: [v0.tf, v0.tb, v1.tb, v1.tf],
                type: 'top'
            });

            // Cara Inferior
            faces.push({
                points: [v0.bf, v1.bf, v1.bb, v0.bb],
                type: 'bottom'
            });
        }

        // Tapas (caps) en el inicio y el final de la línea
        if (pathPoints.length >= 2) {
            const vStart = vertices[0];
            const vEnd = vertices[pathPoints.length - 1];

            // Tapa Inicial
            faces.push({
                points: [vStart.tf, vStart.bf, vStart.bb, vStart.tb],
                type: 'cap'
            });

            // Punta de flecha en el extremo final (Arrowhead 3D)
            const pEnd = pathPoints[pathPoints.length - 1];
            const pPrev = pathPoints[pathPoints.length - 2];

            const dx = pEnd.x - pPrev.x;
            const dy = pEnd.y - pPrev.y;
            const len = Math.sqrt(dx * dx + dy * dy);

            if (len > 0.1) {
                const tx = dx / len;
                const ty = dy / len;
                const nx = -ty;
                const ny = tx;

                const arrowWidth = width * 2.0;
                const arrowLength = width * 1.8;

                // Vértices de la punta de flecha (Punta, Izquierda, Derecha)
                const tipPt = { x: pEnd.x + tx * arrowLength * 0.4, y: pEnd.y + ty * arrowLength * 0.4 };
                const baseCenter = { x: pEnd.x - tx * arrowLength * 0.6, y: pEnd.y - ty * arrowLength * 0.6 };

                const leftPt = { x: baseCenter.x + nx * arrowWidth / 2, y: baseCenter.y + ny * arrowWidth / 2 };
                const rightPt = { x: baseCenter.x - nx * arrowWidth / 2, y: baseCenter.y - ny * arrowWidth / 2 };

                const tipF = { x: tipPt.x, y: tipPt.y, z: zFront };
                const tipB = { x: tipPt.x, y: tipPt.y, z: zBack };
                const leftF = { x: leftPt.x, y: leftPt.y, z: zFront };
                const leftB = { x: leftPt.x, y: leftPt.y, z: zBack };
                const rightF = { x: rightPt.x, y: rightPt.y, z: zFront };
                const rightB = { x: rightPt.x, y: rightPt.y, z: zBack };

                // Caras de la punta de flecha en 3D
                // Cara frontal (triángulo)
                faces.push({
                    points: [tipF, leftF, rightF],
                    type: 'front'
                });

                // Cara trasera (triángulo)
                faces.push({
                    points: [tipB, rightB, leftB],
                    type: 'back'
                });

                // Lado izquierdo (con iluminación superior)
                faces.push({
                    points: [tipF, tipB, leftB, leftF],
                    type: 'top'
                });

                // Lado derecho (sombreado)
                faces.push({
                    points: [tipF, rightF, rightB, tipB],
                    type: 'bottom'
                });

                // Base de la flecha
                faces.push({
                    points: [leftF, leftB, rightB, rightF],
                    type: 'cap'
                });
            } else {
                // Tapa Final convencional como respaldo
                const vEnd = vertices[pathPoints.length - 1];
                faces.push({
                    points: [vEnd.tf, vEnd.tb, vEnd.bb, vEnd.bf],
                    type: 'cap'
                });
            }
        }

        return faces;
    }

    // ── Obtener Puntos Activos de la Animación de Entrada ──────────────────────
    function getActivePoints(points, progress) {
        if (progress <= 0) return [];
        if (progress >= 1) return points.map(p => ({ ...p }));

        const active = [];
        const totalSegments = points.length - 1;
        const currentProgress = progress * totalSegments;
        const segmentIndex = Math.floor(currentProgress);
        const segmentFract = currentProgress - segmentIndex;

        for (let i = 0; i <= segmentIndex; i++) {
            active.push({ ...points[i] });
        }

        if (segmentIndex < totalSegments) {
            const pStart = points[segmentIndex];
            const pEnd = points[segmentIndex + 1];
            active.push({
                x: pStart.x + (pEnd.x - pStart.x) * segmentFract,
                y: pStart.y + (pEnd.y - pStart.y) * segmentFract
            });
        }

        return active;
    }

    // ── Dibujar Frame del Canvas ──────────────────────────────────────────────
    function drawFrame(elapsed) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // 1. Obtener progreso de cada fase de animación (0 a 1)
        const pWall = easeOutCubic(Math.max(0, Math.min(1, (elapsed - 0) / 1000)));
        const pFloor = easeOutCubic(Math.max(0, Math.min(1, (elapsed - 500) / 800)));
        const pGrid = easeOutCubic(Math.max(0, Math.min(1, (elapsed - 900) / 600)));
        const pChart = easeOutCubic(Math.max(0, Math.min(1, (elapsed - 1300) / 1500)));

        // 2. Ángulos base (la perspectiva 3D rotada está activa desde el inicio)
        baseAngleX = -0.02;  // 12.6 grados de pitch (inclinación vertical)
        baseAngleY = -0.40; // -22.9 grados de yaw (giro horizontal)

        const targetAngleX = baseAngleX + parallaxX;
        const targetAngleY = baseAngleY + parallaxY;

        // Aplicar interpolación suave (lerp) para el movimiento del ratón
        currentAngleX += (targetAngleX - currentAngleX) * 0.1;
        currentAngleY += (targetAngleY - currentAngleY) * 0.1;

        const zFront = -80 * pFloor;
        const yTop = -60 + 130 * pWall; // La pared crece desde el piso (-60) hasta arriba (70)

        // Calcular dinámicamente los límites del modelo proyectado para centrarlo perfectamente
        const pointsToBound = [
            rotatePoint(-130, yTop, 0, currentAngleX, currentAngleY),
            rotatePoint(130, yTop, 0, currentAngleX, currentAngleY),
            rotatePoint(130, -60, 0, currentAngleX, currentAngleY),
            rotatePoint(-130, -60, 0, currentAngleX, currentAngleY),
            rotatePoint(-130, -60, zFront, currentAngleX, currentAngleY),
            rotatePoint(130, -60, zFront, currentAngleX, currentAngleY)
        ];

        let minX = Infinity, maxX = -Infinity;
        let minY = Infinity, maxY = -Infinity;
        for (const pt of pointsToBound) {
            const proj = projectRotatedRaw(pt);
            if (proj.x < minX) minX = proj.x;
            if (proj.x > maxX) maxX = proj.x;
            if (proj.y < minY) minY = proj.y;
            if (proj.y > maxY) maxY = proj.y;
        }

        offsetX = canvas.width / 2 - (minX + maxX) / 2;
        offsetY = canvas.height / 2 - (minY + maxY) / 2;

        // ── A. DIBUJAR LA PARED DE FONDO ──
        const pTL = projectRotated(rotatePoint(-130, yTop, 0, currentAngleX, currentAngleY));
        const pTR = projectRotated(rotatePoint(130, yTop, 0, currentAngleX, currentAngleY));
        const pBR = projectRotated(rotatePoint(130, -60, 0, currentAngleX, currentAngleY));
        const pBL = projectRotated(rotatePoint(-130, -60, 0, currentAngleX, currentAngleY));

        ctx.beginPath();
        ctx.moveTo(pTL.x, pTL.y);
        ctx.lineTo(pTR.x, pTR.y);
        ctx.lineTo(pBR.x, pBR.y);
        ctx.lineTo(pBL.x, pBL.y);
        ctx.closePath();

        // Sombreado dinámico de la pared según el ángulo de la cámara
        const wallRotNorm = rotatePoint(0, 0, 1, currentAngleX, currentAngleY);
        const wallDot = wallRotNorm.x * light.x + wallRotNorm.y * light.y + wallRotNorm.z * light.z;
        const wallI = 0.75 + 0.25 * Math.max(0, wallDot);

        const wR = Math.round(18 * wallI);
        const wG = Math.round(22 * wallI);
        const wB = Math.round(48 * wallI);
        ctx.fillStyle = `rgb(${wR}, ${wG}, ${wB})`;
        ctx.fill();

        // ── B. DIBUJAR LÍNEAS DE LA CUADRÍCULA EN LA PARED ──
        if (pGrid > 0) {
            ctx.strokeStyle = `rgba(131, 166, 208, ${0.18 * pGrid})`;
            ctx.lineWidth = 1;

            // Líneas Horizontales
            for (let y = -60; y <= 70; y += 26) {
                if (y > yTop) continue;
                const xMax = 130 * pGrid;
                const gpStart = projectRotated(rotatePoint(-xMax, y, 0, currentAngleX, currentAngleY));
                const gpEnd = projectRotated(rotatePoint(xMax, y, 0, currentAngleX, currentAngleY));

                ctx.beginPath();
                ctx.moveTo(gpStart.x, gpStart.y);
                ctx.lineTo(gpEnd.x, gpEnd.y);
                ctx.stroke();
            }

            // Líneas Verticales
            for (let x = -130; x <= 130; x += 26) {
                const yMax = -60 + (Math.min(70, yTop) - (-60)) * pGrid;
                const gpStart = projectRotated(rotatePoint(x, -60, 0, currentAngleX, currentAngleY));
                const gpEnd = projectRotated(rotatePoint(x, yMax, 0, currentAngleX, currentAngleY));

                ctx.beginPath();
                ctx.moveTo(gpStart.x, gpStart.y);
                ctx.lineTo(gpEnd.x, gpEnd.y);
                ctx.stroke();
            }
        }

        // ── C. DIBUJAR LA SOMBRA SUAVE DEL GRÁFICO EN LA PARED ──
        const activePoints = getActivePoints(chartPoints, pChart);
        const ribbonDepth = 18 * Math.min(1, pChart * 1.5);

        if (activePoints.length >= 2) {
            ctx.save();
            if (ctx.filter !== undefined) {
                ctx.filter = `blur(${Math.max(2, 8 * baseScale)}px)`;
            }
            ctx.strokeStyle = 'rgba(0, 0, 0, 0.45)';
            ctx.lineWidth = 14 * baseScale;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            ctx.beginPath();
            for (let i = 0; i < activePoints.length; i++) {
                const pt = activePoints[i];
                // Proyecta los puntos centrales sobre el plano de la pared (Z=0) con desfase de luz
                const sz = -4 - ribbonDepth / 2;
                const sx = pt.x + 0.35 * (-sz);
                const sy = pt.y - 0.5 * (-sz);

                const pS = projectRotated(rotatePoint(sx, sy, 0, currentAngleX, currentAngleY));
                if (i === 0) ctx.moveTo(pS.x, pS.y);
                else ctx.lineTo(pS.x, pS.y);
            }
            ctx.stroke();
            ctx.restore();
        }

        // ── D. DIBUJAR EL PISO ──
        if (pFloor > 0) {
            const pfBL = projectRotated(rotatePoint(-130, -60, 0, currentAngleX, currentAngleY));
            const pfBR = projectRotated(rotatePoint(130, -60, 0, currentAngleX, currentAngleY));
            const pfFR = projectRotated(rotatePoint(130, -60, zFront, currentAngleX, currentAngleY));
            const pfFL = projectRotated(rotatePoint(-130, -60, zFront, currentAngleX, currentAngleY));

            ctx.beginPath();
            ctx.moveTo(pfBL.x, pfBL.y);
            ctx.lineTo(pfBR.x, pfBR.y);
            ctx.lineTo(pfFR.x, pfFR.y);
            ctx.lineTo(pfFL.x, pfFL.y);
            ctx.closePath();

            // El piso es ligeramente más oscuro que la pared
            const floorRotNorm = rotatePoint(0, 1, 0, currentAngleX, currentAngleY);
            const floorDot = floorRotNorm.x * light.x + floorRotNorm.y * light.y + floorRotNorm.z * light.z;
            const floorI = 0.5 + 0.5 * Math.max(0, floorDot);

            const fR = Math.round(12 * floorI);
            const fG = Math.round(14 * floorI);
            const fB = Math.round(32 * floorI);
            ctx.fillStyle = `rgb(${fR}, ${fG}, ${fB})`;
            ctx.fill();

            // Líneas de la cuadrícula en el piso
            if (pGrid > 0) {
                ctx.strokeStyle = `rgba(131, 166, 208, ${0.13 * pGrid})`;

                // Líneas de profundidad (Z)
                for (let x = -130; x <= 130; x += 26) {
                    const pStart = projectRotated(rotatePoint(x, -60, 0, currentAngleX, currentAngleY));
                    const pEnd = projectRotated(rotatePoint(x, -60, zFront, currentAngleX, currentAngleY));

                    ctx.beginPath();
                    ctx.moveTo(pStart.x, pStart.y);
                    ctx.lineTo(pEnd.x, pEnd.y);
                    ctx.stroke();
                }

                // Líneas transversales (X)
                for (let z = 0; z >= -80; z -= 16) {
                    if (z < zFront) continue;
                    const xMax = 130 * pGrid;
                    const pStart = projectRotated(rotatePoint(-xMax, -60, z, currentAngleX, currentAngleY));
                    const pEnd = projectRotated(rotatePoint(xMax, -60, z, currentAngleX, currentAngleY));

                    ctx.beginPath();
                    ctx.moveTo(pStart.x, pStart.y);
                    ctx.lineTo(pEnd.x, pEnd.y);
                    ctx.stroke();
                }
            }
        }

        // ── E. DIBUJAR LA LÍNEA DEL GRÁFICO EXTRUIDA EN 3D (Caras Ordenadas) ──
        if (activePoints.length >= 2) {
            const ribbonWidth = 13.5;
            const faces = generateRibbonFaces(activePoints, ribbonWidth, ribbonDepth);

            // Proyectar todos los vértices, calcular la normal de cada cara y su Z promedio
            const projectedFaces = [];
            for (const face of faces) {
                const rotPoints = face.points.map(pt => rotatePoint(pt.x, pt.y, pt.z, currentAngleX, currentAngleY));
                const screenPoints = rotPoints.map(projectRotated);

                // Profundidad para ordenar las caras (Algoritmo del Pintor)
                const avgZ = rotPoints.reduce((sum, pt) => sum + pt.z, 0) / rotPoints.length;

                projectedFaces.push({
                    face,
                    rotPoints,
                    screenPoints,
                    avgZ
                });
            }

            // Ordenar de atrás hacia adelante (Z promedio descendente)
            projectedFaces.sort((a, b) => b.avgZ - a.avgZ);

            // Dibujar cada cara ordenada
            for (const pf of projectedFaces) {
                const pts = pf.rotPoints;
                if (pts.length < 3) continue;

                // Calcular la normal tridimensional de la cara rotada
                const ux = pts[1].x - pts[0].x;
                const uy = pts[1].y - pts[0].y;
                const uz = pts[1].z - pts[0].z;
                const vx = pts[2].x - pts[0].x;
                const vy = pts[2].y - pts[0].y;
                const vz = pts[2].z - pts[0].z;

                let nx = uy * vz - uz * vy;
                let ny = uz * vx - ux * vz;
                let nz = ux * vy - uy * vx;
                const len = Math.sqrt(nx * nx + ny * ny + nz * nz);
                if (len > 0) { nx /= len; ny /= len; nz /= len; }

                // Intensidad de iluminación según la dirección de la luz (más ambiental para dar brillo)
                const dot = nx * light.x + ny * light.y + nz * light.z;
                const intensity = 0.65 + 0.35 * Math.max(0, dot);

                // Colores base del tema (Rojo Crimson vibrante y puro sombreado por cara)
                let baseColor = [255, 20, 20];
                if (pf.face.type === 'top') baseColor = [255, 130, 130];
                else if (pf.face.type === 'bottom') baseColor = [180, 10, 10];
                else if (pf.face.type === 'cap') baseColor = [235, 25, 25];
                else if (pf.face.type === 'back') baseColor = [180, 10, 10];

                const r = Math.round(baseColor[0] * intensity);
                const g = Math.round(baseColor[1] * intensity);
                const b = Math.round(baseColor[2] * intensity);

                ctx.fillStyle = `rgb(${r}, ${g}, ${b})`;
                ctx.strokeStyle = `rgb(${r}, ${g}, ${b})`;
                ctx.lineWidth = 0.5; // Evita micro-huecos/bordes de fondo entre caras

                ctx.beginPath();
                ctx.moveTo(pf.screenPoints[0].x, pf.screenPoints[0].y);
                for (let i = 1; i < pf.screenPoints.length; i++) {
                    ctx.lineTo(pf.screenPoints[i].x, pf.screenPoints[i].y);
                }
                ctx.closePath();
                ctx.fill();
                ctx.stroke();
            }

            // Dibujar la etiqueta "-11%" flotando arriba de la punta de la flecha al final de la animación
            if (pChart > 0.8) {
                const labelOpacity = Math.max(0, Math.min(1, (pChart - 0.8) / 0.2));

                // Usamos la posición del último punto activo (la flecha)
                const pEnd = activePoints[activePoints.length - 1];

                // Posicionar la etiqueta sobre la flecha (desfasada hacia arriba en Y=26, Z=-4)
                const label3D = { x: pEnd.x, y: pEnd.y + 26, z: -4 };
                const labelRot = rotatePoint(label3D.x, label3D.y, label3D.z, currentAngleX, currentAngleY);
                const pLabel = projectRotated(labelRot);

                ctx.save();
                ctx.globalAlpha = labelOpacity;

                // Configurar fuente
                const text = "-11%";
                ctx.font = "bold 19px system-ui, -apple-system, sans-serif";
                const textWidth = ctx.measureText(text).width;
                const padX = 7;
                const padY = 4;
                const badgeW = textWidth + padX * 2;
                const badgeH = 15 + padY * 2;

                const bx = pLabel.x - badgeW / 2;
                const by = pLabel.y - badgeH / 2;

                // Fondo del badge redondeado con sombra de brillo
                ctx.beginPath();
                if (typeof ctx.roundRect === 'function') {
                    ctx.roundRect(bx, by, badgeW, badgeH, 5);
                } else {
                    ctx.rect(bx, by, badgeW, badgeH);
                }
                ctx.fillStyle = "rgba(255, 20, 20, 0.95)";
                ctx.shadowColor = "rgba(255, 20, 20, 0.6)";
                ctx.shadowBlur = 8;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                ctx.fill();

                // Texto blanco centrado
                ctx.shadowBlur = 0;
                ctx.fillStyle = "#ffffff";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(text, pLabel.x, pLabel.y + 1);

                ctx.restore();
            }
        }
    }

    // ── Controlador del Bucle de Animación ────────────────────────────────────
    function startLoop() {
        if (!isAnimating) {
            isAnimating = true;
            requestAnimationFrame(loop);
        }
    }

    function loop() {
        if (!startTime) return;
        const elapsed = performance.now() - startTime;

        drawFrame(elapsed);

        let needsMoreFrames = false;

        // Mantener animando durante las fases iniciales (hasta 4.2 segundos)
        if (elapsed < 4200) {
            needsMoreFrames = true;
        } else {
            // O si la rotación interactiva por el mouse no se ha estabilizado
            const targetAngleX = baseAngleX + parallaxX;
            const targetAngleY = baseAngleY + parallaxY;
            const diffX = Math.abs(currentAngleX - targetAngleX);
            const diffY = Math.abs(currentAngleY - targetAngleY);

            // Seguir ejecutando el ciclo si se está moviendo o si hay hover activo
            if (diffX > 0.0005 || diffY > 0.0005 || isHovered) {
                needsMoreFrames = true;
            }
        }

        if (needsMoreFrames) {
            requestAnimationFrame(loop);
        } else {
            isAnimating = false;
        }
    }

    // ── Manejo de Redimensionado (Resize) ─────────────────────────────────────
    function resize() {
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();

        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;

        offsetX = canvas.width / 2;
        offsetY = canvas.height / 2;

        const scaleX = canvas.width / maxDimX;
        const scaleY = canvas.height / maxDimY;
        baseScale = Math.min(scaleX, scaleY) * 0.58; // 42% de margen para evitar cortes con el paralaje

        if (startTime) {
            // Volver a dibujar el frame actual inmediatamente en el resize
            const elapsed = performance.now() - startTime;
            drawFrame(elapsed);
        }
    }

    // Inicializar dimensiones
    resize();
    window.addEventListener('resize', resize);

    // ── Paralaje Interactivo con el Ratón (Hover) ─────────────────────────────
    if (dataBlock) {
        dataBlock.addEventListener('mouseenter', () => {
            isHovered = true;
            startLoop();
        });

        dataBlock.addEventListener('mousemove', (e) => {
            const rect = dataBlock.getBoundingClientRect();
            // Coordenadas relativas al centro de la tarjeta normalizadas a [-1, 1]
            const mx = (e.clientX - rect.left - rect.width / 2) / (rect.width / 2);
            const my = (e.clientY - rect.top - rect.height / 2) / (rect.height / 2);

            // Ajustes sutiles de la rotación base
            parallaxY = mx * 0.22;  // Máximo ajuste de ~12.5 grados de yaw
            parallaxX = -my * 0.12; // Máximo ajuste de ~7 grados de pitch
            startLoop();
        });

        dataBlock.addEventListener('mouseleave', () => {
            isHovered = false;
            parallaxX = 0;
            parallaxY = 0;
            startLoop();
        });
    }

    // ── Activador de Entrada en Viewport (IntersectionObserver) ────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!startTime) {
                    startTime = performance.now();
                    startLoop();
                }
            }
        });
    }, { threshold: 0.15 });

    observer.observe(canvas);
});
