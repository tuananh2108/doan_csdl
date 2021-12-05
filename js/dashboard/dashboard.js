let timedowns = document.querySelectorAll('.ThoiHan');
for (let timedown of timedowns) {
    if(parseInt(timedown.textContent) <= 0) {
        timedown.parentElement.classList.add('table-danger');
    }
    else if (parseInt(timedown.textContent) > 0 && parseInt(timedown.textContent) <= 20) {
        timedown.parentElement.classList.add('table-info');
    }
    else if (parseInt(timedown.textContent) > 20 && parseInt(timedown.textContent) <= 100) {
        timedown.parentElement.classList.add('table-warning');
    }
}