const search = () =>{
    const searchbox = document.getElementById("search-item").value.toUpperCase();
    const storeitems = document.getElementById("shopList");
    const shop = document.querySelectorAll(".shop");
    const shopName = storeitems.getElementsByTagName("h5");
    const shopCategory = storeitems.getElementsByTagName("small");

    for(var i=0;i<shopName.length;i++){
        let match = shop[i].getElementsByTagName('h5')[0];

        if(match){
            let textvalue = match.textContent || match.innerHTML

            if(textvalue.toUpperCase().indexOf(searchbox) > -1){
                shop[i].style.display = "";

            }else{
                shop[i].style.display = "none";
            }
        }
    }
}