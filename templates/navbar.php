<ul>
    <li><a href="/"><img class="logo" src="/images/logo/logo.png"></a></li>
    <li><a href="/"><img src="/images/icons/home.png"><span>Home</span></a></li>
    <li id="navbar-events-icon"><a href="/eventos"><img src="/images/icons/event.png"><span>Eventos</span></a></li>
    <li><a href="/membros"><img src="/images/icons/theatre.png"><span>Membros</span></a></li>
    <li><a href="/personagens"><img src="/images/icons/superhero.png"><span>Personagens</span></a></li>
    <li id="navbar-search-icon"><a title="Clique duplo para ir para a página de pesquisa."><img src="/images/icons/search.png"></a></li>    
</ul>

<script>
    const navbarLis = document.getElementsByClassName("navbar")[0].getElementsByTagName("li");
    let pinnedLi;
    if (window.location.pathname === "/")
        pinnedLi = Array.from(navbarLis).filter(li => li.getElementsByTagName("span")[0] && li.getElementsByTagName("span")[0].innerText == "Home")[0];
    else {
        for (pinnedLi of navbarLis) {
            if (pinnedLi.getElementsByTagName("span")[0] && pinnedLi.getElementsByTagName("span")[0].innerText.toLowerCase() == window.location.pathname.substring(1).toLowerCase()) break;
        }    
    }
    
    if (pinnedLi) {
        pinnedLi.classList.add("navbar-active-option");
        pinnedLi.getElementsByTagName("img")[0].src = pinnedLi.getElementsByTagName("img")[0].src.replace(".png", "-filled.png");   
    }
</script>