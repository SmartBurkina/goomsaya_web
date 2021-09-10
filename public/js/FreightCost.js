
function calculateAirFreightCost() {
    var poids = document.getElementById("poids").value;
    var cost = poids * 10;
    var trueCost = Math.round((cost + Number.EPSILON) * 100) / 100;
    document.getElementById("costAir").innerHTML = trueCost+" €"
}

function calculateFrBf() {
    var longeur = document.getElementById("longeurFr").value;
    var largeur = document.getElementById("largeurFr").value;
    var hauteur = document.getElementById("hauteurFr").value;
    // console.log("values = longeur : "+longeur+", largeur : "+largeur+", hauteur : "+hauteur);
    var value = (longeur / 100) * (largeur / 100) * (hauteur /100);
    var cbm = Math.round((value + Number.EPSILON) * 1000) / 1000;
    var cost = cbm * 475;
    var trueCost = Math.round((cost + Number.EPSILON) * 100) / 100;
    // console.log("cbm value = "+trueCost);
    document.getElementById("costFr").innerHTML = "Frais d'envoie : "+trueCost+" €"
}

function calculateCnBf() {
    var longeur = document.getElementById("longeurCn").value;
    var largeur = document.getElementById("largeurCn").value;
    var hauteur = document.getElementById("hauteurCn").value;
    // console.log("values = longeur : "+longeur+", largeur : "+largeur+", hauteur : "+hauteur);
    var value = (longeur / 100) * (largeur / 100) * (hauteur /100);
    var cbm = Math.round((value + Number.EPSILON) * 1000) / 1000;
    var cost = cbm * 280000;
    var trueCost = Math.round((cost + Number.EPSILON) * 100) / 100;
    // console.log("cbm value = "+trueCost);
    document.getElementById("costCn").innerHTML = "Frais d'envoie : "+numStr(trueCost, ".")+" F CFA"
}

function initFreighCostView() {
    document.getElementById("freighCostFrBf").style.display = "block";
    document.getElementById("freighCostCnBf").style.display = "none";
}

function numStr(a, b) {
    a = '' + a;
    b = b || ' ';
    var c = '',
        d = 0;
    while (a.match(/^0[0-9]/)) {
        a = a.substr(1);
    }
    for (var i = a.length-1; i >= 0; i--) {
        c = (d !== 0 && d % 3 === 0) ? a[i] + b + c : a[i] + c;
        d++;
    }
    return c;
}

function showOrHide(type) {
    if (type === "FrBf"){
        document.getElementById("freighCostFrBf").style.display = "block";
        document.getElementById("freighCostCnBf").style.display = "none";
    }else if (type === "CnBf"){
        document.getElementById("freighCostFrBf").style.display = "none";
        document.getElementById("freighCostCnBf").style.display = "block";
    }
}
