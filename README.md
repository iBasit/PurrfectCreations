# Purrfect Creations


## Full-Stack Developer Task

Alice has recently started a business selling 3D printed jewellery for cats.

As you would expect business is booming and Alice wants to keep track of the success of the business with a metrics dashboard.

She is currently managing her orders in a spreadsheet in Airtable and would like to continue to be able to do so.

She would like her dashboard to contain some key figures, such as:
- Total Orders
- Total Orders this month
- Number of orders in progress
- Revenue
- A list of the most recent few orders
..and anything else that you think that she may find useful.

  
## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Things we can improve later on

* Cache data, so we don't have to load data everytime
* Webhook Airtable to receive updates instantly
* Improve interface
* Pagination on recent orders
* ...

## Ref

1. [Airtable Documentation](https://airtable.com/app8wLQrrIMrnn673/api/docs#curl/table:orders:fields)
2. [Data Sheet](https://airtable.com/app8wLQrrIMrnn673/tblZBNaHCGVfA9xw1/viwzkMXSgvYFa0m2V?blocks=hide)
