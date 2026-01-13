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






