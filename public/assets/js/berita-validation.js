document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('beritaForm');
    const editor = document.getElementById('isi');
    const wordCountDisplay = document.getElementById('wordCount');
    const toolbar = document.querySelector('.editor-toolbar');
    const minChars = 50;

    if (form && editor) {
        // Function to update character count
        function updateCharCount() {
            const content = editor.value.trim();
            const charCount = content.length;
            
            if (wordCountDisplay) {
                wordCountDisplay.textContent = `${charCount} karakter`;
                
                if (charCount < minChars) {
                    wordCountDisplay.classList.add('text-danger');
                    wordCountDisplay.classList.remove('text-success');
                } else {
                    wordCountDisplay.classList.add('text-success');
                    wordCountDisplay.classList.remove('text-danger');
                }
            }

            return charCount;
        }

        // Initialize toolbar buttons
        if (toolbar) {
            toolbar.querySelectorAll('.editor-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const command = this.dataset.command;
                    
                    // Get selection
                    const start = editor.selectionStart;
                    const end = editor.selectionEnd;
                    const selectedText = editor.value.substring(start, end);
                    
                    // Apply formatting
                    let newText = selectedText;
                    switch(command) {
                        case 'bold':
                            newText = `<strong>${selectedText}</strong>`;
                            break;
                        case 'italic':
                            newText = `<em>${selectedText}</em>`;
                            break;
                        case 'underline':
                            newText = `<u>${selectedText}</u>`;
                            break;
                        case 'insertUnorderedList':
                            newText = `<ul>\n<li>${selectedText}</li>\n</ul>`;
                            break;
                        case 'insertOrderedList':
                            newText = `<ol>\n<li>${selectedText}</li>\n</ol>`;
                            break;
                    }
                    
                    // Insert formatted text
                    editor.value = editor.value.substring(0, start) + newText + editor.value.substring(end);
                    editor.focus();
                    updateCharCount();
                });
            });
        }

        // Add input event listeners
        editor.addEventListener('input', updateCharCount);
        editor.addEventListener('change', updateCharCount);

        // Form submission validation
        form.addEventListener('submit', function(e) {
            const charCount = updateCharCount();
            
            if (charCount < minChars) {
                e.preventDefault();
                alert('Isi berita minimal harus 50 karakter!');
                editor.focus();
            }
        });

        // Initial count
        updateCharCount();
    }
});
