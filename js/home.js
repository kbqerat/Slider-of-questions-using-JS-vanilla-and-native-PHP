"use strict";

/*

WORKING ON THE SLIDER 

*/

// declaring the left/right sliders and the next button + the forms in our documents
let currentSlide = 0;

let mainDiv = document.querySelector(".formDiv");

let leftSlider = document.querySelector(".fa-arrow-left");
let rightSlider = document.querySelector(".fa-arrow-right");

let validateForm = document.querySelector("button.submit-button");

let forms = Array.from(document.querySelectorAll("div.form"));

// function to remove active class from all forms
let removeActiveClass = function () {
  if (currentSlide < 9) {
    forms.forEach((form) => {
      form.classList.remove("active");
    });
  }
};

// when the user clicks on the right slider
rightSlider.addEventListener("click", () => {
  removeActiveClass();
  currentSlide++;
  mainDiv.scrollTop = 0;

  // we add the active class to the current slide
  forms[currentSlide].classList.add("active");

  // Remove the disabled class from the left slider
  leftSlider.classList.remove("disabled");

  // Disable next slider after reaching the last form
  if (
    document.querySelector('div[name="form9"]').classList.contains("active")
  ) {
    rightSlider.classList.add("disabled");
    validateForm.classList.remove("disabled");
  }
});
// Disable the left slider by default
if (document.querySelector('div[name="form1"]').classList.contains("active")) {
  leftSlider.classList.add("disabled");
}

// when the user clicks on the left slider
leftSlider.addEventListener("click", () => {
  currentSlide--;
  removeActiveClass();
  mainDiv.scrollTop = 0;

  // add the active class to the current slide
  forms[currentSlide].classList.add("active");

  // Remove the disabled class from the right slider and next button
  rightSlider.classList.remove("disabled");
  validateForm.classList.add("disabled");
  validateForm.classList.remove("active");

  // Disable the left slider after reaching the first form
  if (forms[0].classList.contains("active")) {
    leftSlider.classList.add("disabled");
  }
});

/*

WORKING ON THE INPUTS

*/

// Antecedents
let mstRadioOui = document.getElementById("mstOui");
let mstRadioNon = document.getElementById("mstNon");
let mstValueLabel = document.querySelector(".mstValueLabel");
let mstValue = document.getElementById("mstValue");
mstRadioOui.addEventListener("click", function () {
  showText(mstRadioOui, mstValueLabel, mstValue);
});
mstRadioNon.addEventListener("click", function () {
  showText(mstRadioOui, mstValueLabel, mstValue);
});

let priseRadioOui = document.getElementById("priseOui");
let priseRadioNon = document.getElementById("priseNon");
let priseMValueLabel = document.querySelector(".priseMValueLabel");
let priseMValue = document.getElementById("priseMValue");
priseRadioOui.addEventListener("click", function () {
  showText(priseRadioOui, priseMValueLabel, priseMValue);
});
priseRadioNon.addEventListener("click", function () {
  showText(priseRadioOui, priseMValueLabel, priseMValue);
});

let antUvRadioOui = document.getElementById("antUvOui");
let antUvRadioNon = document.getElementById("antUvNon");
let antUvValueLabel = document.querySelector(".antUvValueLabel");
let antUvValue = document.getElementById("antUvValue");
antUvRadioOui.addEventListener("click", function () {
  showText(antUvRadioOui, antUvValueLabel, antUvValue);
});
antUvRadioNon.addEventListener("click", function () {
  showText(antUvRadioOui, antUvValueLabel, antUvValue);
});

let toxRadioOui = document.getElementById("toxOui");
let toxRadioNon = document.getElementById("toxNon");
let toxValueLabel = document.querySelector(".toxValueLabel");
let toxValue = document.getElementById("toxValue");
toxRadioOui.addEventListener("click", function () {
  showText(toxRadioOui, toxValueLabel, toxValue);
});
toxRadioNon.addEventListener("click", function () {
  showText(toxRadioOui, toxValueLabel, toxValue);
});

// Investigations
let nfsRadioNormal = document.getElementById("nfsNormal");
let nfsRadioAnormale = document.getElementById("nfsAnormale");
let nfsValueLabel = document.querySelector(".nfsValueLabel");
let nfsValue = document.getElementById("nfsValue");
nfsRadioNormal.addEventListener("click", function () {
  showText(nfsRadioAnormale, nfsValueLabel, nfsValue);
});
nfsRadioAnormale.addEventListener("click", function () {
  showText(nfsRadioAnormale, nfsValueLabel, nfsValue);
});

let vsRadioNormale = document.getElementById("vsNormale");
let vsRadioElevee = document.getElementById("vsElevee");
let vsValueLabel = document.querySelector(".vsValueLabel");
let vsValue = document.getElementById("vsValue");
vsRadioNormale.addEventListener("click", function () {
  showText(vsRadioElevee, vsValueLabel, vsValue);
});
vsRadioElevee.addEventListener("click", function () {
  showText(vsRadioElevee, vsValueLabel, vsValue);
});

let crpRadioNormale = document.getElementById("crpNormale");
let crpRadioElevee = document.getElementById("crpElevee");
let crpValueLabel = document.querySelector(".crpValueLabel");
let crpValue = document.getElementById("crpValue");
crpRadioNormale.addEventListener("click", function () {
  showText(crpRadioElevee, crpValueLabel, crpValue);
});
crpRadioElevee.addEventListener("click", function () {
  showText(crpRadioElevee, crpValueLabel, crpValue);
});

let eppRadioNormale = document.getElementById("eppNormale");
let eppRadioAnormale = document.getElementById("eppAnormale");
let eppValueLabel = document.querySelector(".eppValueLabel");
let eppValue = document.getElementById("eppValue");
eppRadioNormale.addEventListener("click", function () {
  showText(eppRadioAnormale, eppValueLabel, eppValue);
});
eppRadioAnormale.addEventListener("click", function () {
  showText(eppRadioAnormale, eppValueLabel, eppValue);
});

let ecaRadioNormal = document.getElementById("ecaNormal");
let ecaRadioAnormal = document.getElementById("ecaAnormal");
let ecaValueLabel = document.querySelector(".ecaValueLabel");
let ecaValue = document.getElementById("ecaValue");
ecaRadioNormal.addEventListener("click", function () {
  showText(ecaRadioAnormal, ecaValueLabel, ecaValue);
});
ecaRadioAnormal.addEventListener("click", function () {
  showText(ecaRadioAnormal, ecaValueLabel, ecaValue);
});

let bilanRadioCalciqueNormal = document.getElementById("bilanCalciqueNormal");
let bilanRadioCalciqueEleve = document.getElementById("bilanCalciqueEleve");
let bilanCalciqueValueLabel = document.querySelector(
  ".bilanCalciqueValueLabel"
);
let bilanCalciqueValue = document.getElementById("bilanCalciqueValue");
bilanRadioCalciqueNormal.addEventListener("click", function () {
  showText(
    bilanRadioCalciqueEleve,
    bilanCalciqueValueLabel,
    bilanCalciqueValue
  );
});
bilanRadioCalciqueEleve.addEventListener("click", function () {
  showText(
    bilanRadioCalciqueEleve,
    bilanCalciqueValueLabel,
    bilanCalciqueValue
  );
});

let rxSinusRadioNormale = document.getElementById("rxSinusNormale");
let rxSinusRadioAnormale = document.getElementById("rxSinusAnormale");
let rxSinusValueLabel = document.querySelector(".rxSinusValueLabel");
let rxSinusValue = document.getElementById("rxSinusValue");
rxSinusRadioNormale.addEventListener("click", function () {
  showText(rxSinusRadioAnormale, rxSinusValueLabel, rxSinusValue);
});
rxSinusRadioAnormale.addEventListener("click", function () {
  showText(rxSinusRadioAnormale, rxSinusValueLabel, rxSinusValue);
});

let rxBassinRadioNormale = document.getElementById("rxBassinNormale");
let rxBassinRadioAnormale = document.getElementById("rxBassinAnormale");
let rxBassinValueLabel = document.querySelector(".rxBassinValueLabel");
let rxBassinValue = document.getElementById("rxBassinValue");
rxBassinRadioNormale.addEventListener("click", function () {
  showText(rxBassinRadioAnormale, rxBassinValueLabel, rxBassinValue);
});
rxBassinRadioAnormale.addEventListener("click", function () {
  showText(rxBassinRadioAnormale, rxBassinValueLabel, rxBassinValue);
});

let rxRachisNormale = document.getElementById("rxRachisNormale");
let rxRachisRadioAnormale = document.getElementById("rxRachisAnormale");
let rxRachisValueLabel = document.querySelector(".rxRachisValueLabel");
let rxRachisValue = document.getElementById("rxRachisValue");
rxRachisNormale.addEventListener("click", function () {
  showText(rxRachisRadioAnormale, rxRachisValueLabel, rxRachisValue);
});
rxRachisRadioAnormale.addEventListener("click", function () {
  showText(rxRachisRadioAnormale, rxRachisValueLabel, rxRachisValue);
});

let rxSacroRadioNormale = document.getElementById("rxSacroNormale");
let rxSacroRadioAnormale = document.getElementById("rxSacroAnormale");
let rxSacroValueLabel = document.querySelector(".rxSacroValueLabel");
let rxSacroValue = document.getElementById("rxSacroValue");
rxSacroRadioNormale.addEventListener("click", function () {
  showText(rxSacroRadioAnormale, rxSacroValueLabel, rxSacroValue);
});
rxSacroRadioAnormale.addEventListener("click", function () {
  showText(rxSacroRadioAnormale, rxSacroValueLabel, rxSacroValue);
});

let thoraciqueRadioNormale = document.getElementById("thoraciqueNormale");
let thoraciqueRadioAnormale = document.getElementById("thoraciqueAnormale");
let thoraciqueValueLabel = document.querySelector(".thoraciqueValueLabel");
let thoraciqueValue = document.getElementById("thoraciqueValue");
thoraciqueRadioNormale.addEventListener("click", function () {
  showText(thoraciqueRadioAnormale, thoraciqueValueLabel, thoraciqueValue);
});
thoraciqueRadioAnormale.addEventListener("click", function () {
  showText(thoraciqueRadioAnormale, thoraciqueValueLabel, thoraciqueValue);
});

// Etiologie
let maladieSysRadioOui = document.getElementById("maladieSysOui");
let maladieSysRadioNon = document.getElementById("maladieSysNon");
let maladieSysValueLabel = document.querySelector(".maladieSysValueLabel");
let maladieSysValue = document.getElementById("maladieSysValue");
maladieSysRadioOui.addEventListener("click", function () {
  showText(maladieSysRadioOui, maladieSysValueLabel, maladieSysValue);
});
maladieSysRadioNon.addEventListener("click", function () {
  showText(maladieSysRadioOui, maladieSysValueLabel, maladieSysValue);
});

let infectieuseRadioOui = document.getElementById("infectieuseOui");
let infectieuseRadioNon = document.getElementById("infectieuseNon");
let infectieuseValueLabel = document.querySelector(".infectieuseValueLabel");
let infectieuseValue = document.getElementById("infectieuseValue");
infectieuseRadioOui.addEventListener("click", function () {
  showText(infectieuseRadioOui, infectieuseValueLabel, infectieuseValue);
});
infectieuseRadioNon.addEventListener("click", function () {
  showText(infectieuseRadioOui, infectieuseValueLabel, infectieuseValue);
});

// Traitement
let antiInfecRadioOui = document.getElementById("antiInfecOui");
let antiInfecRadioNon = document.getElementById("antiInfecNon");
let antiInfecValueLabel = document.querySelector(".antiInfecValueLabel");
let antiInfecValue = document.getElementById("antiInfecValue");
antiInfecRadioOui.addEventListener("click", function () {
  showText(antiInfecRadioOui, antiInfecValueLabel, antiInfecValue);
});
antiInfecRadioNon.addEventListener("click", function () {
  showText(antiInfecRadioOui, antiInfecValueLabel, antiInfecValue);
});

let proteinesRadioOui = document.getElementById("proteinesOui");
let proteinesRadioNon = document.getElementById("proteinesNon");
let biotherapieAutresLabel = document.querySelector(".biotherapieAutresLabel");
let biotherapieAutres = document.getElementById("biotherapieAutres");
proteinesRadioOui.addEventListener("click", function () {
  showText(proteinesRadioOui, biotherapieAutresLabel, biotherapieAutres);
});
proteinesRadioNon.addEventListener("click", function () {
  showText(proteinesRadioOui, biotherapieAutresLabel, biotherapieAutres);
});

// Evolution
let complicationRadioOui = document.getElementById("complicationOui");
let complicationRadioNon = document.getElementById("complicationNon");
let complicationValueLabel = document.querySelector(".complicationValueLabel");
let complicationValue = document.getElementById("complicationValue");
complicationRadioOui.addEventListener("click", function () {
  showText(complicationRadioOui, complicationValueLabel, complicationValue);
});
complicationRadioNon.addEventListener("click", function () {
  showText(complicationRadioOui, complicationValueLabel, complicationValue);
});

// function that toggle the input text based on the radio input checked
function showText(target, inputLabel, inputText) {
  if (target.checked) {
    inputLabel.classList.remove("hidden");
    inputText.classList.remove("hidden");
  } else {
    inputLabel.classList.add("hidden");
  }
}

// Examen-clinique
let avAtteintRadioNormal = document.getElementById("avAtteintNormal");
let avAtteintRadioDiminue = document.getElementById("avAtteintDiminue");
let avAtteintDiminueDiv = document.querySelector(".avAtteintDiminue");
let diminueValueSurDixLabel = document.querySelector(
  ".diminueValueSurDixLabel"
);
let diminueValueSurDix = document.querySelector(".adelpheDiminueValueSurDix");
avAtteintRadioNormal.addEventListener("click", function () {
  if (avAtteintRadioDiminue.checked) {
    avAtteintDiminueDiv.classList.remove("hidden");
    diminueValueSurDixLabel.classList.remove("hidden");
    diminueValueSurDix.classList.remove("hidden");
  } else {
    avAtteintDiminueDiv.classList.add("hidden");
    diminueValueSurDixLabel.classList.add("hidden");
  }
});
avAtteintRadioDiminue.addEventListener("click", function () {
  if (avAtteintRadioDiminue.checked) {
    avAtteintDiminueDiv.classList.remove("hidden");
    diminueValueSurDixLabel.classList.remove("hidden");
    diminueValueSurDix.classList.remove("hidden");
  } else {
    avAtteintDiminueDiv.classList.add("hidden");
    diminueValueSurDixLabel.classList.add("hidden");
  }
});

let avAdelpheRadioNormal = document.getElementById("avAdelpheNormal");
let avAdelpheRadioDiminue = document.getElementById("avAdelpheDiminue");
let avAdelpheDiminueDiv = document.querySelector(".avAdelpheDiminue");
let adelpheDiminueValueSurDixLabel = document.querySelector(
  ".adelpheDiminueValueSurDixLabel"
);
let adelpheDiminueValueSurDix = document.getElementById(
  "adelpheDiminueValueSurDix"
);
avAdelpheRadioNormal.addEventListener("click", function () {
  if (avAdelpheRadioDiminue.checked) {
    avAdelpheDiminueDiv.classList.remove("hidden");
    adelpheDiminueValueSurDixLabel.classList.remove("hidden");
    adelpheDiminueValueSurDix.classList.remove("hidden");
  } else {
    avAdelpheDiminueDiv.classList.add("hidden");
    adelpheDiminueValueSurDixLabel.classList.add("hidden");
  }
});
avAdelpheRadioDiminue.addEventListener("click", function () {
  if (avAdelpheRadioDiminue.checked) {
    avAdelpheDiminueDiv.classList.remove("hidden");
    adelpheDiminueValueSurDixLabel.classList.remove("hidden");
    adelpheDiminueValueSurDix.classList.remove("hidden");
  } else {
    avAdelpheDiminueDiv.classList.add("hidden");
    adelpheDiminueValueSurDixLabel.classList.add("hidden");
  }
});
