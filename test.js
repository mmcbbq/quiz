const xhttp = new XMLHttpRequest();
let answer = null;


xhttp.onload = function () {
    // console.log(this.responseText)
    let respone =  JSON.parse(this.responseText) ;
    let queDiv =document.createElement('div');
    let queText = document.createTextNode(respone[0].text)
    queDiv.appendChild(queText);
    document.body.appendChild(queDiv)
    console.log(respone[0].answers[1])

    const xhttp2 = new XMLHttpRequest();

    xhttp2.onload = function (){
        console.log(xhttp2.responseText);
    }
    xhttp2.open('GET','http://' + respone[0].answers[1]);
    xhttp2.send();
}

xhttp.open('GET','http://localhost/quiz/questions');
xhttp.send()

console.log(answer);