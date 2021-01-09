require('./bootstrap');
// import select2 from select2

window.slugify = function(text){
    return text.toString().toLowerCase()
    .replace(/\s+/g, '-')      // Replace Spaces With -
    .replace(/[^\w\-]+/g, '')  // Remove all non-world chars
    .replace(/\-\-+/g, '-')    // Replace multiple - with Single -
    .replace(/^-+/, '')        // Trim - from start of text
    .replace(/-+$/, '');       // Trim - from end of text
}