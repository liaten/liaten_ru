const repos = [
  "ComplexSystemInformation",
  "kanban-board"
];
for (const props in repos){
  let repo = repos[props];
  let url = "https://api.github.com/repos/liaten/"+repo+"/branches/master";
  let div = repo + "-date";
  class LatestCommitComponent extends React.Component {
    constructor(props) {
      super(props);
      this.state = {
        date: ""
      };
    }
  
    componentDidMount() {
      fetch(url)
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
      return (
        <div>
          <div>{this.state.date}</div>
        </div>
      );
    }
  }
  
  ReactDOM.render(<LatestCommitComponent />, document.getElementById(div));
}
