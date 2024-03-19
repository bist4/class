// // Get the Department select element
// var departmentSelect = document.getElementById('department');
// // Get the other select elements
// var yearLevelSelect = document.getElementById('yearlevel');
// var semesterSelect = document.getElementById('semester');
// var strandSelect = document.getElementById('strand');
// var specializationSelect = document.getElementById('specialization');
// var sectionSelect = document.getElementById('section');
// var roomTypeSelect = document.getElementById('roomType');
// var subjectSelect = document.getElementById('subject');
// var instructorSelect = document.getElementById('instructor');

// // Add an event listener to the Department select
// departmentSelect.addEventListener('change', function () {
//     if (departmentSelect.value === 'Senior High School') {
//         yearLevelSelect.disabled = false;
//         semesterSelect.disabled = false;
//         strandSelect.disabled = false;
//         specializationSelect.disabled = false;
//         sectionSelect.disabled = false;
//         roomTypeSelect.disabled = false;
//         subjectSelect.disabled = false;
//         instructorSelect.disabled = false;
//         // Enable other select elements
//     } else {
//         yearLevelSelect.disabled = true;
//         semesterSelect.disabled = true;
//         strandSelect.disabled = true;
//         specializationSelect.disabled = true;
//         sectionSelect.disabled = true;
//         roomTypeSelect.disabled = true;
//         subjectSelect.disabled = true;
//         instructorSelect.disabled = true;
//         // Disable other select elements
//     }
// });

$(document).ready(function (){
    $('#department').change(function(){
        var departmentID = $(this).val();

        //Ajax to fetch all data when department selected
        $.ajax({
            url: '../GetData/get_department.php',
            type: 'POST',
            data: { departmentID: departmentID},
            success: function(data){
                // $('#yearlevel').html(data);
                // $('#semester').html(data);
                // $('#subject').html(data);
                $('#instructor').html(data);
            }
        });
    });
});
