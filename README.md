# Solution for Cube Summation challenge



## Application architecture:
![App](https://s10.postimg.org/qagyil3wp/cube_summation.jpg)

**FrontEnd**
- View layer: Users interface developed with HTML5 and Bootstrap
- View Controller layer: Manage data renderization and proxy to API/backend layer using Javascript and Jquery

**BackEnd**
- API Endpoints(Routes/web.php): RESFUL interphase that works like a proxy between frontEnd and front controllers that generates process to resolve clients request.
- Controller (app/http/Controllers/CubeController.php): Its responsability is to implements whole operations and resolve clients request, it uses the persistence layer to store and retrieve data.
- Persistence (app/CubeData.php): Store and mange whole data related with bussiness process

**Feature test / Unit Test**
- PHPUniit


