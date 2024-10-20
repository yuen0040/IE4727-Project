# IE4727-Project

## Getting Started

Install required npm modules

```
npm install
```

Run the following command to watch for changes in your files:

```
npx tailwindcss -i ./src/input.css -o ./src/output.css --watch
```

Start using Tailwind in your HTML

## Design Document

https://docs.google.com/document/d/1QTCraUHNuCLcFJseHwiC8NwYbF1CgmqnvdOWSUJhHrQ/edit?tab=t.0

## Sitemap & Storyboard

https://www.figma.com/board/P0SnIFfbC4I7OlGrCkxOy9/Sitemap?node-id=0-1&t=VuXU9Zk6VppqnLMZ-1

## Wireframe

https://www.figma.com/design/GDbHOtJsmO3jqrMfN3Wstg/Design-Project?node-id=1-1180&t=VuXU9Zk6VppqnLMZ-1

## Functional Requirements and Specifications

### Header & Footer

Provide navigation links to, Sign-in, Register, Shop, view the Shopping Cart, and a navigation bar with search functionality for links to allow ease of navigation to important pages and features.

### Register Page

Form with fields for user registration (name, email, password) which includes password validation (minimum length, special characters, etc.).

### Sign-in Page (Authentication)

Form with fields for email and password, “Forget Password” link to reset password, and error messages for incorrect login details (such as incorrect password, invalid email, etc.).

### Main Page (Landing Page)

Display new products.

### Shop Page

Displays all available products, including the ability to filter by price, category, sale and “Load More” button to load more products.

### Product Page

Displays individual product details (such as images, description, price, sizes available).
Select desired product and ”Add to Cart” button.

### Shopping Cart Page

Lists all selected products, quantity, and subtotal, including the ability to update quantities or remove items.
“Sign in” button if the user is not logged in (you must be logged in to purchase).
“Checkout” button leading to the checkout page.

### Checkout Page

Form for entering shipping details, display of order summary, including shipping costs and taxes.

### Order Confirmation Page

Email is sent for confirmed orders.

### Account (Profile) Page + Order History Page

#### Account (Profile) Tab

Allows users to update personal information (e.g., name, email, password).

#### Order History Tab

Shows past orders.
View orders’ details (items purchased, total cost, and shipping details), by listing previous orders with order numbers, dates, and statuses.
Clicking on a current order goes to the Order View page.

### Order View Page

Allows users to cancel orders after finalising orders.
Change delivery addresses.
