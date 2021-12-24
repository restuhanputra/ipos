Void = NonValue-Returning

<!-- 
Link : https://stackoverflow.com/questions/31706611/why-does-the-html-input-with-type-number-allow-the-letter-e-to-be-entered-in/31706796
this avoids 'e', '-', '+', '.' ... all characters that are not numbers !
To allow number keys only: -->
onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 && !event.key == ' ' ? true : !isNaN(Number(event.key))"
<!-- 
isNaN(Number(event.key)) // but accept "Backspace" (keyCode: 8) and "Delete" (keyCode: 46) .
adding && !event.key == ' ' solves the problem of spaces.
 -->