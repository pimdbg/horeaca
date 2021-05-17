class SelectorReservedTime{
    constructor(){
        this.selectedDate;
        this.selectedDay;
        this.openingsHours={
            opened: '',
            closed: ''
        };

        this.setSelectedDate();
        this.setSelectedDay();
        this.prepareFillSelector();
        this.clearSelector();
        this.fillSelector();
    }
    
    setSelectedDate(){
        this.selectedDate= $("#datePicker").datepicker("getDate").getTime();
    }
    setSelectedDay(){
        this.selectedDay= new Date(this.selectedDate).toLocaleDateString("en-US", {weekday: "long"});
    }
    prepareFillSelector(){
        if(this.selectedDay == 'Sunday'){
            this.openingsHours={
                opened: 11,
                closed: 18
            };
        }else if(this.selectedDay == 'Monday'){
            this.openingsHours={
                opened: null,
                closed: null
            }
        }
        else{
            this.openingsHours={
                opened: 11,
                closed: 21
            };
        }
    }
    clearSelector(){
        $("select[name=reservationTime]").empty();
    }
    fillSelector(){
        if(this.openingsHours.opened!==null && this.openingsHours.closed!==null){
            $("select[name=reservationTime]").append("<option>---</option>");
            for(var i=this.openingsHours.opened; i<this.openingsHours.closed; i++){
                $("select[name=reservationTime]").append("<option>" + i + ":00" + "</option>");
                $("select[name=reservationTime]").append("<option>" + i + ":30" + "</option>");
            }
        }else {
            $("select[name=reservationTime]").append("<option>---</option>");
        }
    }
}
class SelectorNumberGuests{
    constructor(){
        for(var i=1; i<=12; i++){
            $("select[name=numberGuests]").append("<option>" + i + "</option>");
        }
    }
}