document.body.addEventListener("click", (event) => {
    let today = new Date().toISOString().slice(0, 19).replace('T', ' ');
    let clickData = {
        x: event.pageX,
        y: event.pageY,
        date: today
    }
    axios.post("http://" + window.location.host + "/add-click", clickData);
});
