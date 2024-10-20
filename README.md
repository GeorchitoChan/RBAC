# RBAC en PHP (Role-Based Access Control)

## Descripción

El **Control de Acceso Basado en Roles (RBAC)** es un sistema de gestión de permisos que asigna a los usuarios ciertos **roles**. A su vez, cada rol tiene asociado un conjunto de **permisos**, los cuales definen las acciones que un usuario puede realizar en el sistema. Este enfoque mejora la seguridad, escalabilidad y facilita la administraciÃ³n de permisos en aplicaciones complejas.

## ¿Cómo funciona RBAC?

En PHP, un sistema RBAC puede implementarse de la siguiente manera:

1. **Definición de Roles**: Los roles representan diferentes niveles o categorías de acceso en el sistema, como "admin", "editor", "usuario", etc.

2. **Asignación de Permisos**: Los permisos son las acciones específicas que un usuario puede realizar, como "crear", "editar", "eliminar", "ver". Cada rol tiene uno o más permisos asociados.

3. **Asignación de Roles a Usuarios**: Cada usuario puede tener uno o varios roles. Estos roles determinan los permisos que se le otorgan al usuario.

4. **Validación de Permisos**: Para proteger las funcionalidades del sistema, se verifica si el usuario tiene los permisos necesarios a través de su rol.

## Estructura de la Base de Datos

Para implementar un sistema RBAC, podemos usar las siguientes tablas en una base de datos:

- **roles**: Define los roles disponibles en el sistema.
  ```sql
  CREATE TABLE roles (
      id INT PRIMARY KEY,
      name VARCHAR(50) UNIQUE
  );

- **permissions**: Define los permisos disponibles.
  ```sql
  CREATE TABLE permissions (
      id INT PRIMARY KEY,
      name VARCHAR(50) UNIQUE
  );

- **users**: Define los usuarios del sistema.
  ```sql
  CREATE TABLE users (
      id INT PRIMARY KEY,
      name VARCHAR(100),
      email VARCHAR(100) UNIQUE,
      password VARCHAR(255)
  );

- **role_user**: Relaciona los usuarios con los roles asignados.
  ```sql
  CREATE TABLE role_user (
      user_id INT,
      role_id INT,
      FOREIGN KEY (user_id) REFERENCES users(id),
      FOREIGN KEY (role_id) REFERENCES roles(id)
  );


- **permission_role**: Relaciona los roles con los permisos asignados.
  ```sql
  CREATE TABLE permission_role (
      role_id INT,
      permission_id INT,
      FOREIGN KEY (role_id) REFERENCES roles(id),
      FOREIGN KEY (permission_id) REFERENCES permissions(id)
  );

## Implementación Básica de Validación en PHP

Aquí te mostramos un ejemplo básico de cómo validar si un usuario tiene un permiso específico basado en sus roles:

```php
function userHasPermission($user, $permission) {
    // Obtener los roles asignados al usuario
    $roles = $user->getRoles();

    // Recorrer los roles y verificar si tienen el permiso necesario
    foreach ($roles as $role) {
        if (in_array($permission, $role->getPermissions())) {
            return true;
        }
    }

    // Si ningún rol tiene el permiso, retorna falso
    return false;
}