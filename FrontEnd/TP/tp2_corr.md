# TP 2 -- Correction

## Access to page with JWT
```js
fetch('/path/page', {
  method: 'GET',
  headers: {
    'Authorization': 'Bearer' + authToken //HTTP 1.0 pattern
  }
})
.then(res => res.json())
.then(data => { console.log(data) })
.catch(err => { console.log(err) })
```