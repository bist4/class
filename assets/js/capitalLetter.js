 
//subject code capital letters
const subjectCodeInput = document.getElementById('subCode');

    // Add an event listener to the input field
    subjectCodeInput.addEventListener('input', function () {
        // Convert the input value to uppercase
        subjectCodeInput.value = subjectCodeInput.value.toUpperCase();
});

// Function to capitalize the first letter of each word
function capitalizeWords(input) {
    return input.replace(/\b\w/g, function (match) {
        return match.toUpperCase();
    });
}

// Add an event listener to the input fields for automatic capitalization
document.getElementById("fname").addEventListener("input", function () {
    this.value = capitalizeWords(this.value);
});

// document.getElementById("mname").addEventListener("input", function () {
//     // Check if Middle Name is at least two characters long
//     if (this.value.length >= 3) {
//         this.value = capitalizeWords(this.value);
//     }
// });

const inputMname = document.getElementById("mname");

inputMname.addEventListener("input", function () {
    let mnameVal = inputMname.value;

    if(mnameVal.length > 0){
        mnameVal = mnameVal.charAt(0).toUpperCase()+ mnameVal.slice(1).toLowerCase();
    }

});


document.getElementById("lname").addEventListener("input", function () {
    this.value = capitalizeWords(this.value);
});


