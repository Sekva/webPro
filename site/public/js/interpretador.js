function seletorLang(entrada) {
   // console.log("");
   switch (entrada) {
      case "c":
         return "clike";
         break;
      default:
         return entrada;
   }
}

function interpretar(texto, conteiner) {
   var linhas = texto.split("\n");
   var saida = "";
   var flag = false;
   var lang = "";
   for(var i = 0;i < linhas.length;i++){
      if (linhas[i].includes(";;lang=")) {
         // console.log("achei");
         flag = true;
         lang = linhas[i].split(";;lang=")[1];
         // console.log(lang);
         lang = seletorLang(lang);
         // console.log(lang);
         saida += "<pre class='language-";
         saida += lang;
         saida += "'><code class='language-";
         saida += lang;
         saida += "'>";
      } else {
         if (linhas[i].includes("\t")) {
            console.log("asd");
            saida += "";
         }
         saida += linhas[i];
         saida += "<br>";
         // console.log(linhas[i]);
      }
   }
   if (flag) {
      saida += " </pre></code>";
   }
   document.getElementById(conteiner).innerHTML = saida;
   // console.log(texto);
}

function habilitarTextArea() {

   var textareas = document.getElementsByTagName('textarea');
   var count = textareas.length;
   for(var i=0;i<count;i++){
      textareas[i].onkeydown = function(e){
         if(e.keyCode==9 || e.which==9){
            e.preventDefault();
            var s = this.selectionStart;
            this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
            this.selectionEnd = s+1;
         }
      }
   }

}
