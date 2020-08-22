function seatGenerator (seatno, id, bookedseat)
{
    let rowResult= '';
    let numberOfSeat = seatno;
    let lastSeatName = String.fromCharCode(parseInt((numberOfSeat-3)/4) + 64)
    let lastSeatNumber = 0;
    let rowStart =`
        <div class="row">
        <div class="col-12">
    `;
    let rowEnd =`
        </div>
        </div>
    `;

    for(let i = 1; i <= numberOfSeat; i++) {
        if(i >= 1 && i <= 3) {
            if(i == 1) {
                rowResult += rowStart;
                rowResult += `<div class="mx-auto w-75 extraSeat">`;
                if (bookedseat[i] == 1) {
                    rowResult += `<button type="button" class="bg-warning text-white btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}" disabled>Ex${i}</button>`;
                } else if (bookedseat[i] == 2) {
                    rowResult += `<button type="button" class="bg-danger text-white btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}" disabled>Ex${i}</button>`;
                } else {
                    rowResult += `<button type="button" class="btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}">Ex${i}</button>`;
                }
                rowResult += `<button type="button" class="btn m-1 seatbutton" disabled></button>`;
                rowResult += `<button type="button" class="btn m-1 seatbutton" disabled></button>`;
            }
            
            if(i == 2 || i == 3) {
                if (bookedseat[i] == 1) {
                    rowResult += `<button type="button" class="bg-warning text-white btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}" disabled>Ex${i}</button>`;
                } else if (bookedseat[i] == 2) {
                    rowResult += `<button type="button" class="bg-danger text-white btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}" disabled>Ex${i}</button>`;
                } else {
                    rowResult += `<button type="button" class="btn btn-outline-success m-1 seatbutton extraSeat" seatno="${i}">Ex${i}</button>`;
                }
            }

            if(i == 3) {
                rowResult += `</div>`;
                rowResult += rowEnd;
            }
        } else if(i >=4 && i <= numberOfSeat - 5) {
            if(i % 4 == 0) {
                rowResult += rowStart;
                rowResult += `<div class="mx-auto w-75">`;
            }
            if(i % 2 == 0 && i % 4 != 0) {
                rowResult += `<button type="button" class="btn m-1 seatbutton" disabled></button>`;
            }
            if (bookedseat[i] == 1) {
                rowResult += `<button type="button" class="bg-warning text-white btn btn-outline-success m-1 seatbutton" seatno="${i}" disabled>${String.fromCharCode(parseInt(i/4) + 64)}${i%4+1}</button>`;
            } else if (bookedseat[i] == 2) {
                rowResult += `<button type="button" class="bg-danger text-white btn btn-outline-success m-1 seatbutton" seatno="${i}" disabled>${String.fromCharCode(parseInt(i/4) + 64)}${i%4+1}</button>`;
            } else {
                rowResult += `<button type="button" class="btn btn-outline-success m-1 seatbutton" seatno="${i}">${String.fromCharCode(parseInt(i/4) + 64)}${i%4+1}</button>`;
            }
            if ((i + 1) % 4 == 0) {
                rowResult += `</div>`;
                rowResult += rowEnd;
            }
        } else {
            if (i == numberOfSeat - 4) {
                rowResult += rowStart;
                rowResult += `<div class="mx-auto w-75">`;
            }
            if (bookedseat[i] == 1) {
                rowResult += `<button type="button" class="bg-warning text-white btn btn-outline-success m-1 seatbutton" seatno="${i}" disabled>${lastSeatName}${++lastSeatNumber}</button>`;
            } else if (bookedseat[i] == 2) {
                rowResult += `<button type="button" class="bg-danger text-white btn btn-outline-success m-1 seatbutton" seatno="${i}" disabled>${lastSeatName}${++lastSeatNumber}</button>`;
            } else {
                rowResult += `<button type="button" class="btn btn-outline-success m-1 seatbutton" seatno="${i}">${lastSeatName}${++lastSeatNumber}</button>`;
            }
            if (i == numberOfSeat) {
                rowResult += `</div>`;
                rowResult += rowEnd;
            }
        }
    }
    document.getElementById(id).innerHTML = rowResult;
}


function seatnoconverter (i, totalseat)
{
    let lastSeatName = String.fromCharCode(parseInt((totalseat-3)/4) + 64);
    if(i >= 1 && i <= 3) 
    {
        return "Ex" + i;
    }
    else if(i >=4 && i <= totalseat - 5)
    {
        return String.fromCharCode(parseInt(i/4) + 64) + (i%4 + 1);
    }
    else
    {
        return lastSeatName + (i%5 + 1);
    }
}