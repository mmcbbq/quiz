import {Question} from "./Question.js";

const questions = [];



for (let i = 0; i < 10; i++) {
    const question = new Question(i, 'Test mit Objekten'+i, [
            {id: 5, text: 4, correct: true, checked: false},
            {id: 6, text: 5, correct: false, checked: false},
            {id: 7, text: 6, correct: false, checked: false},
            {id: 8, text: '8/2', correct: true, checked: false}
        ]
    );
    questions.push(question);
}
console.log(questions)


function pages(questions) {
    let i = 1;
    for (const question1 of questions) {
        const qSpan = document.createElement('span');
        const qtext = document.createTextNode(i)
        qSpan.addEventListener('click', clickPage)
        document.body.appendChild(qSpan);
        qSpan.appendChild(qtext);
        i++;
    }
}

function clickPage() {
    document.body.innerHTML = '';
    questions[parseInt(this.innerText)-1].showQ(document.body);
    pages(questions)
}
questions[0].showQ(document.body,)
pages(questions)
