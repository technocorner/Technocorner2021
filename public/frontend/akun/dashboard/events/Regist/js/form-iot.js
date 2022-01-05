//js for form-iot.html
const uploadbtn1iot = document.getElementById('upload1-iot');
const fileuploaded1iot = document.getElementById('fileup1-iot');
uploadbtn1iot.addEventListener('change', function(){
    fileuploaded1iot.textContent = this.files[0].name
})

const uploadbtn2iot = document.getElementById('upload2-iot');
const fileuploaded2iot = document.getElementById('fileup2-iot');
uploadbtn2iot.addEventListener('change', function(){
    fileuploaded2iot.textContent = this.files[0].name
})

const uploadbtn3iot = document.getElementById('upload3-iot');
const fileuploaded3iot = document.getElementById('fileup3-iot');
uploadbtn3iot.addEventListener('change', function(){
    fileuploaded3iot.textContent = this.files[0].name
})