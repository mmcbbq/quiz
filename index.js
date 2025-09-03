import {Question} from "./Question.js";

const questions = [];

for (let i = 0; i < 10; i++) {
    const question = new Question({
        id:
        i, text: 'Test mit Objekten' + i,
        answers: [{id: 5, text: 4, correct: true, checked: false},
            {
                id: 6, text:
                    5, correct:
                    false, checked:
                    false
            }
            ,
            {
                id: 7, text:
                    6, correct:
                    false, checked:
                    false
            }
            ,
            {
                id: 8, text:
                    '8/2', correct:
                    true, checked:
                    false
            }
        ]
    });
    questions.push(question);
}
console.log(questions)


function pages(questions,clicked) {
    let i = 1;
    for (const question1 of questions) {
        const qSpan = document.createElement('span');
        const qtext = document.createTextNode(i);
        // qSpan.style.padding = '10px';
        qSpan.classList.add("pages");
        if (clicked === i) {
            qSpan.classList.add('pageschecked')
            qSpan.classList.remove("pages");
        }
        qSpan.addEventListener('click', clickPage)
        document.body.appendChild(qSpan);
        qSpan.appendChild(qtext);
        i++;
    }
}

function clickPage() {
    let clickedEleId = parseInt(this.innerText) ;
    document.body.innerHTML = '';
    questions[parseInt(clickedEleId) - 1].showQ(document.body);
    pages(questions,clickedEleId)
}

questions[0].showQ(document.body,)
pages(questions)
