function addCart(id){
    window.location.href = "functions/addCart.PHP?codigo="+id;
}

function getImg(event){
    const file = event.target.files[0]; // 0 = get the first file

     let url = window.URL.createObjectURL(file);

      document.getElementById("importImg").src = url
}