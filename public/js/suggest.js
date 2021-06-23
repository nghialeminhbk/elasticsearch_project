const auto = document.getElementById('autocom-box');

function search(suggest){
    setTimeout(() => {
        console.log(suggest);
        if(suggest == ""){
            auto.setAttribute('style','display: none');
            return;
        }else{
            auto.setAttribute('style','display: flex');
            var xmlhttp = new XMLHttpRequest();
            var url = 'http://localhost:8080/elasticsearchMVC/SuggestController/index/'+suggest;
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    auto.innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
            return;
        }
    }, 300);
}

