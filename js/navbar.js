const balanceBoxes = document.getElementsByClassName("balance-box");
if (balanceBoxes) {
    Array.from(balanceBoxes).forEach(box => {
        const widthElem = box.children[0];
        const valueWidth = widthElem.children[0].offsetWidth;
        const plusWidth = box.children[1].offsetWidth;
        let imgWidth = 0;
        const img = box.getElementsByTagName("img")[0];
        if (img) imgWidth = img.offsetWidth + 5;
        widthElem.style.width = (valueWidth + plusWidth + imgWidth + 5)+"px";
    });
}