# Echo (In progress)

## Overview

Echo is a lightweight PHP framework designed for simplicity and flexibility. It leverages the power of Symfony components, Eloquent ORM, Twig and the Tailwind CSS for a seamless development experience. This framework is ideal for building dynamic web applications with minimal setup.

## Getting Started

### Prerequisites

- **DDEV:** A local development environment tool. Follow the [DDEV installation guide](https://ddev.readthedocs.io/en/stable/) to set it up.

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/imustakim/echo.git
   cd echo
   ```
2. **Start DDEV**:
   ```bash
   ddev start
   ```
3. **Install Dependencies:** Make sure you have Composer and Node.js installed. Run the following command inside your project directory:
   ```bash
   ddev composer install
   ddev npm install
   ```
4. **Set Up Environment Variables:** Create a ``.env`` file in your project root and define the following variables:
   ```env
    DB_DRIVER=mysql
    DB_HOST=db
    DB_DATABASE=db
    DB_USERNAME=db
    DB_PASSWORD=db
    DB_CHARSET=utf8mb4
    DB_COLLATION=utf8mb4_unicode_ci
   ```
5. **Access the Application:** Open your web browser and go to the URL provided by DDEV, usually http://echo.ddev.site.

## Technology stack

 - [Docker](https://www.docker.com/)
 - [DDEV](https://ddev.com/)
 - [PHP](https://www.php.net/)
 - [Symfony](https://symfony.com/)
 - [Node.js](https://nodejs.org/en/)
 - [Twig](https://twig.symfony.com/)
 - [Tailwind CSS](https://tailwindcss.com/)
 - [jQuery](https://jquery.com/)
 - [Webpack](https://webpack.js.org/)


## Contributing
Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
If you have any questions or feedback, feel free to reach out.