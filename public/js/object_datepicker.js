class FormDatepicker{
    constructor(){
        this.setDatepicker();
    }
    setDatepicker(){
        $("#datePicker").datepicker({
            dateFormat: "dd/mm/yy"
        });
        
    }
}