class Calendar{
    constructor(query){
        this.calendarDate = new Date();
        this.currentDate = new Date();
        this.calendar = document.querySelector(query);
        this.dateText = this.calendar.querySelector(".date-text");
        this.btnPrev = this.calendar.querySelector(".btn-prev");
        this.btnNext = this.calendar.querySelector(".btn-next");
        this.divTable = this.calendar.querySelector(".calendar-table-container");

        console.log(this.dateText);
        this.createDateText();
        this.bindEvents();
        this.createCalendarTable();
    }

    createDateText(){
        const monthNames = ["styczeń", "luty", "marzec", "kwiecień",
            "maj", "czerwiec", "lipiec", "sierpień",
            "wrzesień", "październik", "listopad", "grudzień"];
        this.dateText.innerText = `${monthNames[this.calendarDate.getMonth()]} ${this.calendarDate.getFullYear()}`;

    }

    bindEvents(){

        //year, month-1, day, hour, minutes, seconds
        this.btnPrev.addEventListener("click", e=>{
            this.calendarDate = new Date(this.calendarDate.getFullYear(),this.calendarDate.getMonth()-1,
                this.calendarDate.getDay());
            this.createDateText();
            this.createCalendarTable();
        });

        this.btnNext.addEventListener("click", e=>{
            this.calendarDate = new Date(this.calendarDate.getFullYear(),this.calendarDate.getMonth()+1,
                this.calendarDate.getDay());
            this.createDateText();
            this.createCalendarTable();
        });

    }

    createCalendarTable(){

        //czyścimy starą tabele i tworzymy nową
        this.divTable.innerHTML = '';
        const tab = document.createElement("table");
        tab.classList.add("calendar-table");
        this.divTable.appendChild(tab);

        // tworzymy zagłowki z dniami
        let tr = document.createElement("tr");
        tr.classList.add("calendar-table-days-names");
        const days = ["Pon", "Wto", "Śro", "Czw", "Pią", "Sob", "Nie"];

        days.forEach(day => {
            const th = document.createElement("th");
            th.innerHTML = day;
            tr.appendChild(th);
        });
        tab.appendChild(tr);

        // liczymy liczbę dni w miesiącu
        let daysInMonth = new Date(this.calendarDate.getFullYear(),this.calendarDate.getMonth()+1,0).getDate();


        //liczymy pierwszy dzień w miesiącu
        let firstDay = new Date(this.calendarDate.getFullYear(),this.calendarDate.getMonth(),1).getDay();
        if(firstDay===0){ firstDay = 7;}

        let cellNumber = daysInMonth + firstDay - 1;

        for (let i=0;i<cellNumber;i++){

            if(i%7===0){
                tr = document.createElement("tr");
                tab.appendChild(tr);
            }
            let td = document.createElement("td");
            if(i<firstDay-1){
                td.innerHTML = '';
                tr.appendChild(td);
            }
            else{
                td.innerText = String(i - firstDay + 2);
                td.classList.add("day");
                if(this.calendarDate.getFullYear() === this.currentDate.getFullYear()
                && this.calendarDate.getMonth() === this.currentDate.getMonth()
                && (i - firstDay + 2) === this.currentDate.getDate()){
                    td.classList.add("current-day");
                }
				
				const calendarNoteInfoDivs = document.querySelectorAll(".calendarNoteInfo");
				calendarNoteInfoDivs.forEach( div => {
			
					if( Number(div.dataset.noteday) === (i - firstDay + 2) && Number(div.dataset.notemonth) === this.calendarDate.getMonth()+1 && Number(div.dataset.noteyear) === this.calendarDate.getFullYear()){
					td.classList.add("important-day");
					}		
				});

                tr.appendChild(td);
            }
        }
    }


}

const calendar = new Calendar(".calendar");
