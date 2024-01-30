function toggleSections(sectionIds) {
    var sections = document.querySelectorAll('.w3-card-4');
    sections.forEach(function(section) {
        if (sectionIds.includes(section.id)) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}