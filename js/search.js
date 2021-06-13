const content = document.getElementById('content_search');
const inputBox = document.getElementById('input--search');
const icon = document.getElementById('icon');

function _search(page = 1){
    var userData = inputBox.value;
    if(userData){
        var xmlhttp = new XMLHttpRequest();
        document.getElementById('autocom-box').setAttribute('style', 'display: none');
        content.setAttribute('style', 'display: block');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                content.innerHTML = this.responseText;
            }
        }
        xmlhttp.open('GET',"search.php?search="+userData+"&page="+page, true);
        xmlhttp.send();
    }else{
        content.setAttribute('style', 'display: none');
        return;
    }
}
