//js for form-eec.html


const uploadbtn1eec = document.getElementById('upload1-eec');
const fileuploaded1eec = document.getElementById('fileup1-eec');
uploadbtn1eec.addEventListener('change', function(){
    fileuploaded1eec.textContent = this.files[0].name
})

const uploadbtn2eec = document.getElementById('upload2-eec');
const fileuploaded2eec = document.getElementById('fileup2-eec');
uploadbtn2eec.addEventListener('change', function(){
    fileuploaded2eec.textContent = this.files[0].name
})

const uploadbtn3eec = document.getElementById('upload3-eec');
const fileuploaded3eec = document.getElementById('fileup3-eec');
uploadbtn3eec.addEventListener('change', function(){
    fileuploaded3eec.textContent = this.files[0].name
})

const uploadbtn4eec = document.getElementById('upload4-eec');
const fileuploaded4eec = document.getElementById('fileup4-eec');
uploadbtn4eec.addEventListener('change', function(){
    fileuploaded4eec.textContent = this.files[0].name
})
const uploadbtn5eec = document.getElementById('upload5-eec');
const fileuploaded5eec = document.getElementById('fileup5-eec');
uploadbtn5eec.addEventListener('change', function(){
    fileuploaded5eec.textContent = this.files[0].name
})