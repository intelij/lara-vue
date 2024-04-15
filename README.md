# API REPO

Created a Phoenix web application (MarineApp) that provides an API for accessing consolidated AIS data reports. The application is configured with an Ecto Repo module, implements HTTP data reception using gun, and follows Elixir best practices.

## Run Migrations
### Run migrations to create the necessary database tables:

`
mix ecto.setup
`

### Start the Phoenix server:

`
mix phx.server
`

### Verify API Endpoint
`
curl http://localhost:4000/api/position_reports
`

## Dependencies
### Updated mix.exs file to include gun and backoff dependencies:

```
defp deps do
  [
    {:gun, "~> 2.0"},
    {:backoff, "~> 1.0"}
  ]
end
```
