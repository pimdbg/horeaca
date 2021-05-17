function launch(){
    var scrollbar=new Scrollbar(window.pageYOffset);
    
    try{
        var datepicker= new FormDatepicker();
    }
    catch{
        console.log('FormDatePicker unavailable');
    }    
    try{
        var selectorNumberGuests= new SelectorNumberGuests();
    }
    catch{
        console.log('SelectorNumberGuests unavailable');
    }

    if($("#datePicker").val()){
        var selectorReservedTime= new SelectorReservedTime();
    }else{
        try{
            $("#datePicker").on("change", function(){
                var selectorReservedTime= new SelectorReservedTime();
            });
        }
        catch{
            console.log('SelectorReservedTime unavailable');
        }
    }
}

launch();