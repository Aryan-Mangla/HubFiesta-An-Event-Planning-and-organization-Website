

    function validateForm() {
        var description = document.getElementById("floatingTextarea2").value;
        var minWords = 15;
        var words = description.trim().split(/\s+/);
        if (words.length < minWords) {
            alert("Description must contain at least " + minWords + " words.");
            return false;
        }
        return true;
    }
    function validateImageFileType(fileInput) {
        // Get the file name
        var fileName = fileInput.value;
        
        // Check if the file name has a valid extension
        if (/\.(png|jpg|jpeg)$/i.test(fileName)) {
            return true; // Valid file type
        } else {
            alert("Please upload a valid PNG, JPG, or JPEG image file.");
            fileInput.value = ''; // Clear the file input field
            return false; // Invalid file type
        }
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        countWords(); // Call countWords once when the page is loaded
    });
    
    function countWords() {
        var description = document.getElementById("floatingTextarea2").value;
        
        // Remove leading and trailing whitespace and split the input into words
        var words = description.trim().split(/\s+/).filter(function(word) {
            return word.length > 0; // Filter out empty words
        });
        
        // Update the word count display
        document.getElementById("wordCount").textContent = words.length;
    }

