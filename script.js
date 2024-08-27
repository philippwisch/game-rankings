window.addEventListener("load", () => {
    console.log("script loaded");
    document.getElementById('game-rankings-form').onsubmit = (e) => {
        e.preventDefault();
        console.log(e);
    };
});
