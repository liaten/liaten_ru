const repos = [
  "ComplexSystemInformation",
  "kanban-board",
  "WallpaperGet",
  "linux-configs"
];
String.prototype.replaceAt = function(index, replacement) {
  return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}
for (const props in repos){
  let repo = repos[props];
  let url = "https://api.github.com/repos/liaten/"+repo+"/branches/main";
  let div = repo + "-date";
  let accesstoken = "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"; //readonly rights for public repos
  class LatestCommitComponent extends React.Component {
    constructor(props) {
      super(props);
      this.state = {
        date: ""
      };
    }
  
    componentDidMount() {
      fetch(url, {
        headers:{
          'Authorization': accesstoken,
        }
      })
        .then(response => {
          response.json().then(json => {
            console.log(json);
            this.setState({
              date: json.commit.commit.author.date
            });
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
    render() {
      let result = this.state.date;
      result = result.replaceAt(10, " ");
      result = result.replaceAt(19, " ");
      result = result.substring(0,result.length-1);
      return (
        <div>
          <div>{result}</div>
        </div>
      );
    }
  }
  ReactDOM.render(<LatestCommitComponent />, document.getElementById(div));
}
