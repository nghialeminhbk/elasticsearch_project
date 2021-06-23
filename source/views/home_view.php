<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <!-- <title>Autocomplete Search Box | CodingNepal</title> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Elasticsearch App!</title>
</head>

<body>
  <div class="wrapper">
    <div class="search-input">
      <input id="input--search" type="text" placeholder="Type to search.." onkeyup="search(this.value)">
      <div id="autocom-box">
        <!-- here list are inserted from javascript -->
      </div>
      <div id="icon" class="icon" onclick="_search()"><i class="fas fa-search"></i></div>
    </div>
    <div id="content_search"></div>
  </div>

  <!-- <script src="./public/js/search.js"></script>
  <script src="./public/js/suggest.js"></script>
  <script src="./public/js/choose.js"></script> -->
  
  <script>

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

    const content = document.getElementById('content_search');
    const inputBox = document.getElementById('input--search');
    const icon = document.getElementById('icon');

    function _search(page = 1){
        var searchData = inputBox.value;
        if(searchData){
            var xmlhttp = new XMLHttpRequest();
            document.getElementById('autocom-box').setAttribute('style', 'display: none');
            content.setAttribute('style', 'display: block');
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    content.innerHTML = this.responseText;
                }
            }
            xmlhttp.open('GET',"http://localhost:8080/elasticsearchMVC/SearchController/index/" + searchData + "/" + page, true);
            xmlhttp.send();
        }else{
            content.setAttribute('style', 'display: none');
            return;
        }
    }

    function choose(search){
        console.log(search);
        document.getElementById('input--search').value = search;
        document.getElementById('autocom-box').setAttribute('style', 'display: none');
    }


  </script>
</body>

</html>