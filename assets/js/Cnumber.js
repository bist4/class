// function formatPhoneNumber(input) {
//     const value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
//     let formattedValue = '';

//     if (value.length >= 4) {
//         formattedValue += value.substr(0, 4) + ' - ';
//     }
//     if (value.length >= 8) {
//         formattedValue += value.substr(4, 4) + ' - ';
//     }
//     if (value.length >= 12) {
//         formattedValue += value.substr(8, 4);
//     }

//     input.value = formattedValue;
// }
 

function formatPhoneNumber(input) {
    const value = input.value;
    let formattedValue = '';

    if (value.length >= 4) {
        formattedValue += value.substr(0, 4) + ' - ';
    }
    if (value.length >= 8) {
        formattedValue += value.substr(4, 4) + ' - ';
    }
    if (value.length >= 12) {
        formattedValue += value.substr(8, 4);
    }

    input.value = formattedValue;
}