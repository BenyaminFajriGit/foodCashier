# CI CMD

Command helper for creating new Controller and Model in CodeIgniter

## Installation

1. Clone this repo to your project directory `git clone https://github.com/egin10/ci-cmd.git`
2. Copy file `cicmd` and directory `src` to your project directory. It will look like below :

```
Project
    -application
    -system
    -user_guide
    .editorconfig
    .gitignore
    composer.json
    contributing.md
    index.php
    license.txt
    readme.rst
    -src
    cicmd
```

3. Run command with `php cicmd help` to show all available command lits.

## Command List

#### Run Service

    php cicmd
    php cicmd help

The command above will display a list of available commands.

#### Add Controller

    php cicmd add:controller ControllerName

The above command is used to create a new controller. the name of the controller may start with a capital letter or lowercase letter, when the controller is successfully created, the controller file name will automatically begin with a capital letter.

The controller name argument can only be the name of the controller file you want to create, it can also be the location and file name of the controller to be created.

    php cicmd add:controller Controllername
    php cicmd add:controller controllername

The command above will produce a controller file with a file name that starts with a capital letter and will by default be in the `application/controllers/` directory. then the controller will be in `application/controllers/Controllername.php`.

    php cicmd add:controller path/Controllername
    php cicmd add:controller path/controllername

The command above will generate a controller file and create a new directory with the name `path` in the `application/controllers/` directory and will contain the controller file with the file name `Controllername.php`. then the controller will be in `application/controllers/path/Controllername.php`. the `/` becomes a separator, the word at the end of `/` will be the Controllername. path can be more than one, for example :

    php cicmd add:controller path/path/controllername

It will generate a controller in `application/controllers/path/path/Controllername.php`.

#### Add Model

    php cicmd add:model ModelName

The above command is used to create a new model. the model name may begin with a capital letter or lowercase letter, when the model is successfully created, the model file name will automatically begin with a capital letter.

The model name argument can only be the file name of the model you want to create, it can also be the location and file name of the model to be created.

    php cicmd add:model namemodel
    php cicmd add:model namemodel

The command above will generate a model file with file names beginning with capital letters and will by default be in the `application/models/` directory. then the model will be in `application/models/Modelname.php`.

    php cicmd add:model path/Modelname
    php cicmd add:model path/modelname

The command above will generate a model file and create a new directory with the name `path` in the directory `application/models/` and will contain the model file with the file name `Modelname.php`. Then the model will be in `application/models/path/Modelname.php`.
The `/` becomes a separator, the word at the end of `/` will be Modelname. path can be more than one, for example

    php cicmd add:model path/path/modelname

it will produce a model in `application/models/path/path/Modelname.php`.

#### Add Helper

    php cicmd add:helper HelperName

The above command is used to create a new helper. the helper name may begin with a capital letter or lowercase letter, when the helper is successfully created, the helper file name will automatically begin with a capital letter.

The helper name argument can only be the file name of the helper you want to create, it can also be the location and file name of the helper to be created.

    php cicmd add:helper namehelper
    php cicmd add:helper namehelper

The command above will generate a helper file with file names beginning with capital letters and will by default be in the `application/helpers/` directory. then the model will be in `application/helpers/Helpername.php`.

    php cicmd add:helper path/Helpername
    php cicmd add:helper path/helpername

The command above will generate a helper file and create a new directory with the name `path` in the directory `application/helpers/` and will contain the helper file with the file name `Helpername.php`. Then the model will be in `application/helpers/path/Helpername.php`.
The `/` becomes a separator, the word at the end of `/` will be Helpername. path can be more than one, for example

    php cicmd add:helper path/path/helpername

it will produce a helper in `application/helpers/path/path/Helpername.php`.

#### Run Service

    php cicmd run PORT

The command above will run the service with the `php -S localhost:port` command. ports can be given or not. by default if it does not specify a port it will be a `8000` port. then you can access the browser with the address `http://localhost:port/`.


#### Change Logs

    1. Create method to create new Helper (03-19-2019).
    2. Update cicmd.php to cicmd (11-01-2019).

---
