document.getElementById('edit')?.addEventListener('click', async function () {

    const token = document.head.querySelector("[name~=csrf_token][content]").content;
    const id = document.getElementById('cv-id')?.value;
    const name = document.getElementById('name')?.value;

    console.log(name);
    const cv = {
        "cv": {
            name: name,
            info: {
                skills: getSkills(),
                education: getEducation(),
                experience: getExperience()
            }
        }
    }

    try {
        const response = await fetch(`/submit/${id}`,
            {
                method: "POST",
                headers: {
                    "X-CSRF-Token": token,
                    "Content-Type": "application/json",
                },
                credentials: "same-origin",
                redirect: "follow",
                body: JSON.stringify(cv),
            }
        );
        const result = await response.text();
        console.log("Success:", result);

        window.location.href = `/show/${id}`;

    } catch (error) {
        console.error("Error:", error);
    }
});


document.getElementById('create')?.addEventListener('click', async function () {

    const token = document.head.querySelector("[name~=csrf_token][content]").content;
    const name = document.getElementById('name')?.value;


    const cv = {
        "cv": {
            name: name,
            info: {
                skills: getSkills(),
                education: getEducation(),
                experience: getExperience()
            }
        }
    }

    console.log(cv);

    try {
        const response = await fetch(`/create`,
            {
                method: "POST",
                headers: {
                    "X-CSRF-Token": token,
                    "Content-Type": "application/json",
                },
                credentials: "same-origin",
                redirect: "follow",
                body: JSON.stringify(cv),
            }
        );
        const id = await response.text();

        if (id == -1)
            console.log("Error:");
        else if (id > 0) {
            console.log("Success")

        window.location.href = `/show/${id}`;
        }

        //document.getElementById('redirect').submit();

    } catch (error) {
        console.error("Error:", error);
    }
});


function getExperience() {

    const expElements = document.querySelectorAll('.exp-el');

    const experienceArr = [];

    Array.prototype.forEach.call(expElements, function (element) {

        console.log(1);

        const experience = {
            start: Date(),
            end: Date(),
            workplace: '',
            achievements: []
        }

        experience.achievements = getAchievements(element);

        const inputs = element.querySelector('.exp-info').querySelectorAll('.form-control');


        Array.prototype.forEach.call(inputs, function (element) {
            experience[element.name] = element.value;
        });

        experienceArr.push(experience);
    });

    return experienceArr;

}

function getAchievements(educationContainer) {
    const items = educationContainer.querySelectorAll('div.input-group input');
    const achievements = [];

    items.forEach(e => {
        if (e.value != "")
            achievements.push(e.value)
    });

    return achievements;
}

function getSkills() {
    const skills = [];
    const skillContainer = document.getElementById('skills');
    const skillElements = document.querySelectorAll('.skillText');

    // Array.prototype.forEach.call(skillContainer.children, function (element) {
    //     let text = element.firstChild.innerHTML;
    //     if (text && text != "") {
    //         skills.push(text);
    //     }
    // });


    Array.prototype.forEach.call(skillElements, function (element) {
        let text = element.innerText;
        if (text && text != "") {
            skills.push(text);
        }
    });

    return skills;
}


function getEducation() {
    const educationElements = document.querySelectorAll('.edu-info');

    const educationArr = [];

    Array.prototype.forEach.call(educationElements, function (element) {

        const education = {
            start: Date(),
            end: Date(),
            institution: '',
            description: '',
        }

        const inputs = element.querySelectorAll('.form-control');

        Array.prototype.forEach.call(inputs, function (element) {
            education[element.name] = element.value;
        });

        educationArr.push(education);
    });
    return educationArr;
}

function addAchievement(event) {

    const btn = event.currentTarget;

    const list = btn.previousElementSibling;

    let canAdd = true;
    const achievement = `                                        <li class="list-group-item">
    <div class="input-group">
    <input class="form-control" name='achievement' type='text'>
    <button class='btn btn-light' onclick="removeAchievement(event)">
        <i class="fa fa-trash"></i>
    </button>
    </div>
</li>`;

    Array.prototype.forEach.call(list.children, function (element) {
        if (element.firstChild.value == "") {
            canAdd = false;
        }
    });

    if (canAdd) {
        list.insertAdjacentHTML('beforeEnd', achievement);
    }
}

function removeSkill(event) {
    event.currentTarget.parentElement.remove();
}

function removeAchievement(event) {
    event.currentTarget.parentElement.remove();
}

function removeEducation(event) {
    event.currentTarget.parentElement.remove();
}

function removeExperience(event) {
    event.currentTarget.parentElement.remove();
}

document.getElementById('addExp').addEventListener('click', function () {
    const container = document.getElementById('experience-container');

    const tmp = `
    <div class="border p-3 mb-3 exp-el" >
                        <button class="btn btn-light" onclick="removeExperience(event)"><i
                                class="fa fa-trash"></i></button>

                                <div class="exp-info">

                                    <fieldset class="form-group">
                                        <legend>Тривалість</legend>
                                        <div class="row">
                                            <div class="col">
                                                <label >Початок:</label>
                                                <input class="form-control" type="month" name="start">
                                            </div>
                                            <div class="col">
                                                <label >Закінчення:</label>
                                                <input class="form-control" type="month" name="end">
                                            </div>
                                        </div>
                                    </fieldset>
    
                                    <div class="form-group">
                                        <label >Місце роботи:</label>
                                        <input class="form-control" type="text" name="workplace">
                                    </div>

                                </div>

                                <div class="achiev-container">
                                    <ul class="list-group" class="achievements">

                                    </ul>
                                    <button class="btn btn-success" class="addAch" onclick="addAchievement(event)">Додати
                                        досягнення</button>
                                </div>

                    </div>
    `


    const tmp1 = `  <div class="exp-el">
        <button class='btn btn-light' onclick="removeExperience(event)"><i class="fa fa-trash"></i></button>

    <div class="exp-info">
        <label>Поч.</label>
        <input name='start' type="month">
        -
        <label>Закінчення.</label>
        <input name='end' type="month">
        <br />
        <label>Місце роботи</label>
        <input name='workplace' type="text">
        <br />
        Опис
        <br />
    </div>
    <div class="achiev-container">
        <ul class="achievements">
        </ul>
        <button  class='btn btn-success' class="addAch" onclick="addAchievement(event)">Додати</button>
    </div>

</div>`;

    container.insertAdjacentHTML('beforeEnd', tmp);

})

document.getElementById('addEdu').addEventListener('click', function () {
    const container = document.getElementById('edu-container');
    const tmp =
        ` <div class="border p-3 mb-3 edu-el ">
    <button class="btn btn-light" onclick="removeEducation(event)">
        <i class="fa fa-trash"></i>
    </button>

    <div class="edu-info">
        <div class='row'>
            <div class='col'>
                <label>Початок</label>
                <input class="form-control" name="start" type="month">
            </div>
            <div class='col'>
                <label>Закінчення</label>
                <input class="form-control" name="end" type="month">
            </div>
        </div>

        <label>Навчальний заклад</label>
        <input class="form-control"  name="institution" type="text">
        <br />
        Опис
        <br />
        <textarea class="form-control" name="description"></textarea>
    </div>
</div>`;


    container.insertAdjacentHTML('beforeEnd', tmp);
});

document.getElementById('addSkill').addEventListener('click', function () {

    const field = document.getElementById('skillName');
    if (field.value != "") {

        const skill = document.createElement('div');
        skill.classList.add("border", "rounded", "p-2", "m-2", 'skill');

        const text = document.createElement('span');
        text.classList.add('skillText');
        text.innerText = field.value;

        skill.appendChild(text);

        const button = `<button class='btn btn-light' onclick="removeSkill(event)"><i class="fa-solid fa-xmark"></i></button>`;
        skill.insertAdjacentHTML('beforeEnd', button);

        document.getElementById('skills').appendChild(skill);
        field.value = "";
    }
});
