<?php
/**
 * Team Bio — Publications & Recognition Section (Dark Theme)
 * List of articles, conferences, and recognition.
 * Theme: The Crisis Academy
 */
if (!isset($member)) return;

$type_icons = [
    'artículo'    => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
    'conferencia' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>',
    'ponencia'    => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
];
?>
<section id="bio-publications" class="block">
    <div class="publications-bg-glow" aria-hidden="true"></div>
    <div class="content">

        <div class="publications-header">
            <span class="pretext pretext-reveal">Publicaciones & Reconocimientos</span>
            <h2 class="object-reveal">Contribución al conocimiento en gestión de crisis.</h2>
        </div>

        <?php if (!empty($member['publications'])) : ?>
            <div class="publications-list">
                <?php foreach ($member['publications'] as $i => $pub) : ?>
                    <div class="publication-item object-reveal" style="transition-delay: <?php echo ($i * 0.08); ?>s;">
                        <div class="pub-type-badge">
                            <?php echo isset($type_icons[$pub['type']]) ? $type_icons[$pub['type']] : $type_icons['artículo']; ?>
                            <span><?php echo esc_html(ucfirst($pub['type'])); ?></span>
                        </div>
                        <div class="pub-body">
                            <h3 class="pub-title"><?php echo esc_html($pub['title']); ?></h3>
                            <div class="pub-meta">
                                <span class="pub-venue"><?php echo esc_html($pub['venue']); ?></span>
                                <span class="pub-year"><?php echo esc_html($pub['year']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
