const facultyEl = document.querySelector('#faculty');
const departmentEl = document.querySelector('#department');
facultyEl.addEventListener('change', async function (e) {
    const selectedFaculty = e.target.value;

    const facultyJson = await (await fetch(`/faculties/${selectedFaculty}`)).json();


    const departments = facultyJson.departments;


    for (const department in departments) {
        const departmentOption = document.createElement('option');
        departmentOption.value = department.name;
        departmentOption.text = department.id;


    }


});
