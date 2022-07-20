$('#cpf').mask('000.000.000-00', {reverse: true});

//valida o CPF digitado
function ValidarCPF(Objcpf){
    var cpf = Objcpf.value;
    if (cpf.length > 0) {
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" ); 
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;

        for(i=0;i<9;i++){
            soma1+=eval(cpf.charAt(i)*(vlr-1));
            soma2+=eval(cpf.charAt(i)*vlr);
            vlr--;
        }       
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);

        var digitoGerado=(soma1*10)+soma2;
        if(digitoGerado!=digitoDigitado){
            alert('CPF Invalido!');
            Objcpf.value = "";
        } 
    }
    
    
}
