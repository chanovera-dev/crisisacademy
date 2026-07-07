document.addEventListener('DOMContentLoaded', () => {
    if (typeof initHeroCrisisGrid === 'function') {
        initHeroCrisisGrid(
            '#Negligencia', '#MalasPrácticas', '#Escándalo', '#Fraude',
            '#Corrupción', '#Acoso', '#Discriminación', '#Filtración',
            '#Demanda', '#Boicot', '#DespidoMasivo', '#FugaDeDatos',
            '#ProductoDefectuoso', '#Polémica', '#Difamación',
            '#AbusoLaboral', '#LavadoDeDinero', '#CrisisAmbiental',
            '#PublicidadEngañosa', '#Soborno', '#CrisisDeConfianza',
            '#DeclaracionesOfensivas', '#ConflictoDeInterés',
            '#FaltaDeTransparencia', '#ExplotaciónLaboral',
            '#MalaPraxis', '#PlagioCorporativo', '#DañoAmbiental',
            '#ManipulaciónMediatica', '#RetiradaDeProducto',
            '#CrisisSanitaria', '#Impunidad', '#RumoresVirales',
            '#CaídaDeReputación', '#EscándaloFiscal'
        );
    }

    // Interactive hearings radar and panels
    const panels = document.querySelectorAll('#hearings .hearing-panel');
    const quadrants = document.querySelectorAll('#hearings .radar-quadrant');

    function setActiveDepartment(dept) {
        panels.forEach(p => {
            if (p.dataset.department === dept) {
                p.classList.add('active');
            } else {
                p.classList.remove('active');
            }
        });

        quadrants.forEach(q => {
            if (q.dataset.target === dept) {
                q.classList.add('active');
            } else {
                q.classList.remove('active');
            }
        });
    }

    // Set first one active initially
    if (panels.length > 0) {
        const firstDept = panels[0].dataset.department;
        setActiveDepartment(firstDept);
    }

    panels.forEach(panel => {
        panel.addEventListener('mouseenter', () => {
            const dept = panel.dataset.department;
            setActiveDepartment(dept);
        });

        panel.addEventListener('click', () => {
            const dept = panel.dataset.department;
            setActiveDepartment(dept);
        });
    });
});