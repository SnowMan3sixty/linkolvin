# Linkolvin

### Integrants

- Pau Callejas Tovar a18paucaltov@inspedralbes.cat
- Kevin Larriega Palomino a18kevlarpal@inspedralbes.cat
- Ruben Oncina Lopez a18rubonclop@inspedralbes.cat

### Objectiu

    L'objectiu és crear una pagina web que mostri diferents ofertes de feina.

    La part de frontend esta creada amb vue mentre que la part de backend esta creada amb symfony. La dificultat del projecte radica en utilitzar dos frameworks diferents  
    
    Les empreses podràn enviar ofertes de feina a l'administrador perquè aquest 
    les publiqui en cas de semblar-li correctes.

    Els usuaris podràn veure aquestes ofertes e inscriure's a cadascuna d'elles.

    Hi hauràn diferents formes de veure la informació en funció de si ets un usuari corrent, 
    una empresa o l'adminsitrador del portal.

### Estat 

    El projecte es troba parat en aquest moment. 
    Hi han possibles millores documentades al Jira però no hi ha data prevista 
    de incorporar-les o de rependre el projecte.

### Jira Scrum Software

    Enllaç a l'eina de scrum utilitzada:

- http://labs.iam.cat:8080/projects/BT2021G1/summary

### Documentació

#### FrameWorks

    - Vue 
    - Symfony 2.0

#### Software necessari

    Per utilitzar symfony 

    - PHP 8.0.2
    - Symfony 1.1.5
    - Composer

    Per utilitzar vue:

    - Node.js

#### Com arrancar el projecte

    Per a poder editar i fer funcionar el projecte cal:

    - Arrancar symfony:
        - cd \BACKEND 
        - composer install
        - symfony server:start -d
        
        podràs trobar el servidor de backend a http://localhost:8000

    - Arrancar vue
        - cd \FRONTEND\linkolvin
        - npm install
        - npm run serve

        podràs trobar el servidor de frontend a http://localhost:8080




### Adreça del projecte desplegat 

    Degut a incompatibilitats amb el servidor de l'institut `labs.iam.cat` 
    El projecte no ha pogut ser desplegat en producció.