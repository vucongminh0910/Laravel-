
    function Validator(options){
        var formElement = document.querySelector(options.form);
        if(formElement){
            console.log(formElement);
        }

    }
    Validator.isRequired = function(selector){
     return {
        selector: selector,
        test: function(){

        }
    };

    }