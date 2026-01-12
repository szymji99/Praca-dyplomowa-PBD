// zamykanie się lightboxów

const lightboxTab = document.querySelectorAll(".lightbox");
lightboxTab.forEach((el) => {

    el.addEventListener("mousedown", function (e){
        if(e.target === this){
            this.style.opacity = "0";
            this.style.zIndex = "-1";
            const tab = document.querySelectorAll(".phpAddition");
            tab.forEach((el) => {
                el.remove();
            });
        }

    });
});

// Dodanie zdarzeń do panelu logowania i rejestracji

const loginButton = document.querySelector(".topnav-login");
loginButton.addEventListener("click", function (e){

    const el = document.querySelector(".lightbox.login");
    el.style.opacity = "1";
    el.style.zIndex = "100";

});

try{
	const loginRegisterLink = document.querySelector("#loginRegisterLink");
	loginRegisterLink.addEventListener("click", function (e){

		const el1 = document.querySelector(".lightbox.login");
		const el2 = document.querySelector(".lightbox.register");

		el1.style.opacity = "0";
		el1.style.zIndex = "-1";

		el2.style.opacity = "1";
		el2.style.zIndex = "100";
	});
}
catch(err){
	console.log("Link do rejestracji nie zostął utworzony");	
}

try{
	const registerLoginLink = document.querySelector("#registerLoginLink");
	registerLoginLink.addEventListener("click", function (e){

		const el1 = document.querySelector(".lightbox.register");
		const el2 = document.querySelector(".lightbox.login");

		el1.style.opacity = "0";
		el1.style.zIndex = "-1";

		el2.style.opacity = "1";
		el2.style.zIndex = "100";
	});
}
catch(err){
	console.log("Link do logowania nie zostął utworzony");	
}

try{
	const registerLoginLink2 = document.querySelector("#registerLoginLink2");
	registerLoginLink2.addEventListener("click", function (e){

		const el1 = document.querySelector(".lightbox.register");
		const el2 = document.querySelector(".lightbox.login");

		el1.style.opacity = "0";
		el1.style.zIndex = "-1";

		el2.style.opacity = "1";
		el2.style.zIndex = "100";
	});
}
catch(err){
	console.log("Drugi link do logowania nie zostął utworzony");	
}

// Dodanie zdarzeń do elementów kalendarza

const calendarDays = document.querySelectorAll(".day");
console.log(calendarDays);

calendarDays.forEach( function(el) {
	
	el.addEventListener( "click", function (e){
		
		const lightbox = document.querySelector(".lightbox.calendar-day");
		lightbox.style.opacity = 1;
		lightbox.style.zIndex = "100";
		
		const Months = {
			"styczeń":1,
			"luty":2,
			"marzec":3,
			"kwiecień":4,
			"maj":5,
			"czerwiec":6,
			"lipiec":7,
			"sierpień":8,
			"wrzesień":9,
			"październik":10,
			"listopad":11,
			"grudzień":12
		};
		
		const dateDayInput = lightbox.querySelector("#NoteDay");
		const dateMonthInput = lightbox.querySelector("#NoteMonth");
		const dateYearInput = lightbox.querySelector("#NoteYear");
		
		
		let dateYear = String(document.querySelector(".date-text").innerText.split(" ")[1]);
		let dateMonth = String(Months[document.querySelector(".date-text").innerText.split(" ")[0]]);
		let dateDay = String(this.innerText);
		
		dateDayInput.value = dateDay;
		dateMonthInput.value = dateMonth;
		dateYearInput.value = dateYear;
		
		const calendarNoteInfoDivs = document.querySelectorAll(".calendarNoteInfo");
		const lightBoxTextArea = lightbox.querySelector("#day_info");
		let isEmptyTextBox = true;
		
		calendarNoteInfoDivs.forEach( function(div){
			
			if( div.dataset.noteday === dateDay && div.dataset.notemonth === dateMonth && div.dataset.noteyear === dateYear){
				lightBoxTextArea.innerText = div.dataset.notetext;
				isEmptyTextBox = false;
			}
			
		});
		
		if(isEmptyTextBox){
			lightBoxTextArea.innerText = "";
		}
		
		dateMonth = dateMonth.padStart(2,"0");
		dateDay = dateDay.padStart(2,"0");
		const lightboxText = lightbox.querySelector(".day_info_date");
		lightboxText.innerText = dateDay + "." + dateMonth + "." + dateYear;
		
	});
	
});

