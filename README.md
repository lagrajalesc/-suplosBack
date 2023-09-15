# -suplosBack
Backend prueba técnica

Requisitos: 8.1.17 o superior, mysql o mariadb, xampp y cualquier editor de código 
Es importante tomar en cuenta que las siguientes url toman como referencia la estructura de paquetes que yo utilicé,
lo que no van a cambiar son: 
el host y el nombre del archivo donde se ejecuta la api
adicionalmente, importe a su base de datos el archivo de excel bienes_servicios
y ejecute los scrips de la estructura de la base de datos
clone el repositorio en la carpeta hdocs en la carpeta xamp y levante el servidor de apache y de mysql. 

Mediante postman puede revisar las api: 
cree un usuario: 
mediante el método post utilice la url http://localhost/proyectos/PruebaSuplos/user
como parámetros en formato json, debe enviar 
{
    "user" : "correo", ->string
    "password" : "contraseña", ** la contraseña debe contener mínimo 8 caracteres ->string
    "firstName" : "nombre", ->string
    "lastName" : "apellido" ->string
}

en caso de que se cree el usuario, este le retornará un mensaje diciendo que el usuario se ha creado exitosamente
en caso de que no, el le retornará una mensaje indicando qué parámetro le falta, o quizá ya exista un usuario con el corre indicado
Logeese:
mediante el método post utilice la url http://localhost/proyectos/PruebaSuplos/auth
como parámetros debe enviar, en formato json:
{
    "user" : "correo", ->string
    "password" : "contraseña" ->string
}

en caso de se logee, el le retornará el token
en caso de que no, el le retornará un mensaje diciendo que el usuario o la contraseña son invalidos

Cree un evento: 
Mediante el método post utilice la url http://localhost/proyectos/PruebaSuplos/event
como parámetros en formato json, debe enviar 
{
    "assets" : "código producto", ->string
    "description" : "descripción", ->string
    "currency" : tipo de moneda, -> entero
    "endDate" : "fecha", ->date
    "endTime" : "hora", -> time
    "startDate" :  "fecha", ->date
    "startTime" : "hora", -> time
    "token" : "token", -> string
    "budget" : presupuesto, -> decimal 
    "operation_id" : operación -> entero
}

en caso de que se cree un evento, el le retornará un mensaje diciendo que el evento se ha creado exitosamente
en caso de que no, le retornará un mensaje indicando qué parámetro le hizo falta

revise los eventos: 
mediante el método get utilice la url http://localhost/proyectos/PruebaSuplos/getEvents
este le retornará todos los eventos creados(0 o n)
Este método también se utiliza para descargar un archivo de excel con los eventos, pero esto es posible desde el frontend 

actualice los eventos: 
mediante método get use la ur http://localhost/proyectos/PruebaSuplos/updateEventStatus
este validará las horas de inicio y cierre de los eventos, en caso de que estas hayan caducado, actualizará los estaos
y le retornará todos los eventos creados (0 o n)

revise las divisas(tipos de moneda) 
mediante método get use la url http://localhost/proyectos/PruebaSuplos/currency
este le retornará todas la diferentes divisas(0 o n)

revise las operaciones(tipo de operaciones)
mediante método get use la url http://localhost/proyectos/PruebaSuplos/operation
este le retornará todas la diferentes operaciones(0 o n)

revise los bienes o servicios
mediante método get use la url http://localhost/proyectos/PruebaSuplos/assets
este le retornará todas la diferentes bienes o servicios(0 o n)
