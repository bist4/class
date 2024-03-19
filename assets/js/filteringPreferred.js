const departmentInput = document.getElementById('department');
const instructorInput = document.getElementByName('InstructorID')[0];
const subjectInput = document.getElementById('SubjectID');

departmentInput.addEventListener('input', function (e) {

    let departmentValue = departmentInput.value();
    let instructorValue = '';
    let subjectVaue = '';

    switch(departmentValue){
        case 'Senior High School':
            instructorValue = [133, 135, 136];
    }
     
});
