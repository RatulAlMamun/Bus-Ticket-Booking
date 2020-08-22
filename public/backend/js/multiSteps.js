/*=============================================================
					MULTI-STEP-FORM
===============================================================*/
const prevBtn = document.getElementById('prevBtn'),
nextBtn = document.getElementById('nextBtn'),
regForm = document.getElementById('regForm'),
tab = document.getElementsByClassName('tab'),
step = document.getElementsByClassName('step'),
progress = document.getElementsByClassName('progress-bar');

// Current tab is set to be the first tab (0)
let currentTab = 0;

// Display the current tab
showTab(currentTab);


// This function will display the specified tab of the form
function showTab(count) {
    tab[count].style.display = 'block';

    if (count === 0) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'flex';
    }

    if (count === (tab.length - 1)) {
        nextBtn.innerHTML = 'Submit';
    } else {
        nextBtn.innerHTML = 'Next';
    }

    fixStepIndicator(count);
}

// This function will figure out which tab to display
function nextPrev(count) {
    if (count === 1 && !validateForm()) {
        return false;
    }

    tab[currentTab].style.display = 'none';
    currentTab = currentTab + count;

    if (currentTab >= tab.length) {
        regForm.submit();
        return false;
    }

    showTab(currentTab);
}

// This function deals with validation of the form fields
function validateForm() {
    let inputField, valid = true;
    inputField = tab[currentTab].getElementsByTagName('input');

    for (let i = 0; i < inputField.length; i++) {
        var email = inputField[i].getAttribute("id");
        if(email == 'email' && inputField[i].value == '') {
            continue;
        } else if (inputField[i].value == '') {
            inputField[i].className += ' invalid';
            valid = false;
        }
    }
    var busselect = document.getElementById('bus');
    console.log(busselect.value);
    if (busselect.value == '') {
        busselect.className += ' invalid';
        valid = false;
    }
    var busrouteselect = document.getElementById('route');
    if (busrouteselect.value == '') {
        busrouteselect.className += ' invalid';
        valid = false;
    }
    if (valid) {
        step[currentTab].className += ' finish';
    }

    return valid;
}

// This function removes the "active" class of all steps
function fixStepIndicator(count) {
    for (let i = 0; i < step.length; i++) {
        step[i].className = step[i].className.replace(' active', '');
    }
    step[count].className += ' active';
}