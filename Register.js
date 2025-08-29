document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        let hasError = false;

        const errors = document.querySelectorAll(".error");
        errors.forEach(err => err.remove());

        function showError(element, message) {
            const errorDiv = document.createElement("div");
            errorDiv.className = "error";
            errorDiv.style.color = "red";
            errorDiv.innerText = message;
            element.parentNode.insertBefore(errorDiv, element.nextSibling);
            hasError = true;
        }
        const fields = ["first_name", "last_name", "username", "email", "dob", "country", "state", "city"];
        fields.forEach(id => {
            const input = document.getElementById(id);
            if (!input.value.trim()) {
                showError(input, "This field is required");
            }
        });

        const languages = document.querySelectorAll('input[name="languages[]"]');
        let languageSelected = false;
        languages.forEach(lang => {
            if (lang.checked) languageSelected = true;
        });
        if (!languageSelected) {
            const languageDiv = languages[0].closest(".checkbox-group");
            showError(languageDiv, "Select at least one language");
        }

        if (hasError) {
            event.preventDefault(); 
        }
    });
});
