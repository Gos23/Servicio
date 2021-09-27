function reorganiza(arreglo, campo, primario) {
   let res = { };
   for (let actual of arreglo) {
      if (primario) {
         res[actual[campo]] = actual;
      } else {
         if (res[actual[campo]] == undefined) {
            res[actual[campo]] = [ ];
         }
         res[actual[campo]].push(actual);
      }
   }
   return res;
}
