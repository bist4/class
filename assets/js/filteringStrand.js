const strandCodeInput = document.getElementById('sCode');
const strandNameInput = document.getElementById('sName');
const trackTypeSelect = document.getElementById('track');
const specializationSelect = document.getElementById('spec');

strandCodeInput.addEventListener('input', function () {
    const strandCodeValue = strandCodeInput.value.toUpperCase();
    let strandNameValue = '';
    let trackTypeValue = '';
    let validSpecializations = [];

    switch (strandCodeValue) {
        case 'ICT':
            strandNameValue = 'Information Communication Technology';
            trackTypeValue = 'Technical-Vocational Livelihood';
            validSpecializations = [20, 21, 22, 23, 24, 25, 26];
            break;
        case 'HE':
            strandNameValue = 'Home Economics';
            trackTypeValue = 'Technical-Vocational Livelihood';
            validSpecializations = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
            break;
        case 'ABM':
            strandNameValue = 'Accountancy, Business and Management';
            trackTypeValue = 'Academic Track';
            const validSpecializationsABM = [1, 27, 28, 29, 30, 31, 32, 33, 34];
            updateSpecializationOptions(validSpecializationsABM);
            break;
        case 'HUMSS':
            strandNameValue = 'Humanities and Social Sciences';
            trackTypeValue = 'Academic Track';
            const validSpecializationsHumss = [35, 36, 37, 38, 39, 40, 41, 42, 43];
            updateSpecializationOptions(validSpecializationsHumss);
            break;
        case 'STEM':
            strandNameValue = 'Science, Technology, Engineering, and Mathematics';
            trackTypeValue = 'Academic Track';
			const validSpecializationsStem = [44, 45, 46, 47, 48, 49, 50, 43];
            updateSpecializationOptions(validSpecializationsStem);
            break;
        case 'GAS':
            strandNameValue = 'General Academic Strand';
            trackTypeValue = 'Academic Track';
            const validSpecializationsGas = [51, 52, 53, 54, 55, 56, 57, 43];
            updateSpecializationOptions(validSpecializationsGas);
            break;
        // Add cases for other strand codes here...
        default:
            strandNameValue = '';
            trackTypeValue = '';
            break;
    }

    strandNameInput.value = strandNameValue;
    trackTypeSelect.value = trackTypeValue;

    
    
    updateSpecializationOptions(validSpecializations);
});

function updateSpecializationOptions(validSpecializations) {
    const allOptions = specializationSelect.options;
    for (let i = 0; i < allOptions.length; i++) {
        const specializationID = parseInt(allOptions[i].value);
        if (validSpecializations.includes(specializationID)) {
            allOptions[i].disabled = false;
        } else {
            allOptions[i].disabled = true;
        }
    }
    // If the selected specializations are hidden, reset the values
    const selectedOptions = Array.from(specializationSelect.selectedOptions);
    for (const option of selectedOptions) {
        if (option.disabled) {
            option.selected = false;
        }
    }
}

trackTypeSelect.addEventListener('change', function () {
    const selectedOption = trackTypeSelect.value;
    let validSpecializations = [];

    switch (selectedOption) {
        case 'Academic Track':
            validSpecializations = [1, 27, 28, 29, 30, 31, 32, 33, 34];
            break;
        case 'Technical-Vocational Livelihood':
            validSpecializations = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
            break;
        // Add more cases for other track types here...
    }

    updateSpecializationOptions(validSpecializations);
});

// Add an event listener to the input field to convert the input to uppercase
strandCodeInput.addEventListener('input', function () {
    strandCodeInput.value = strandCodeInput.value.toUpperCase();
});
