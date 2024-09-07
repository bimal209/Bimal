let isValidPassphrase = (text) => {
  
     let words = text.split(" ");

  
     let a = words.length>=4;

   let b= words.every(word=> word.length >= 2);

  let conditionsSatisfied =a && b;
  
  return conditionsSatisfied;
  
}

console.log(isValidPassphrase("this should be enough"));

module.exports = isValidPassphrase;
